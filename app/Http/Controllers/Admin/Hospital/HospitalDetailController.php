<?php

namespace App\Http\Controllers\Admin\Hospital;

use App\Models\User;
use App\Models\Nurse;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Qualification;
use GuzzleHttp\Promise\Create;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Pharmacist;
use App\Models\Receptionist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Input\Input;

use function Flasher\Prime\flash;

class HospitalDetailController extends Controller
{
    public function detail(Request $request, $id)
    {
        $tab = $request->query('tab'); 
        
        $hospital = Hospital::findOrFail($id);
        
        switch ($tab) {
            case 'doctor':
                
                $doctors = Doctor::with(['user', 'department', 'hospital.user', 'qualification'])
                    ->where('hospital_id', $hospital->id)
                    ->latest()
                    ->get();
                    
                return view('admin.hospital.tabs.doctor.index', compact('doctors', 'hospital'));
                
            case 'nurses':
                $nurses = Nurse::with(['user', 'department', 'hospital.user', 'qualifications'])
                    ->where('hospital_id', $hospital->id)
                    ->latest()
                    ->get();
                return view('admin.hospital.tabs.nurse.index', compact('nurses', 'hospital'));

                case 'receptionists':
                    $receptionists = Receptionist::with(['user', 'hospital.user'])
                        ->where('hospital_id', $hospital->id)
                        ->latest()
                        ->get();
                    return view('admin.hospital.tabs.receptionist.list', compact('receptionists', 'hospital'));
                
                case 'pharmacists':
                    $pharmacists = Pharmacist::with(['user', 'department', 'hospital.user', 'qualification'])
                        ->where('hospital_id', $hospital->id)
                        ->latest()
                        ->get();
                    return view('admin.hospital.tabs.pharmacist.list', compact('pharmacists', 'hospital'));

                case 'patients' :
                    $patients = Patient::with(['user', 'hospital.user'])
                        ->where('hospital_id', $hospital->id)
                        ->latest()
                        ->get();
                    return view('admin.hospital.tabs.appointments.list', compact('patients', 'hospital'));
                
                case 'departments' :
                    $departments = Department::where(['hospital_id' => $hospital->id])
                         ->withCount('doctors', 'nurses')
                         ->get();
                    return view('admin.hospital.tabs.department.list', compact('departments', 'hospital'));

                case 'laboratories' :
            // Add more cases for other tabs...

            default:
                return response()->json(['message' => 'Invalid tab'], 400);
        }
    }
    
    public function view_doctor($id)
    {
        $doctor = Doctor::with('user', 'department', 'hospital.user', 'qualification')->find($id);
        if (!$doctor) {
            return redirect()->back()->with('error', 'Doctor not found');
        }

        return view('admin.hospital.tabs.doctor.view', compact('doctor'));
    }

// ...

    public function edit_doctor(Doctor $doctor)
    {
        // load related models
        $doctor->load(['user', 'hospital', 'department', 'qualification']);

        $hospitals = Hospital::all();

        return view('admin.hospital.tabs.doctor.edit', compact('doctor', 'hospitals'));
    }

    public function update_doctor(Request $request, Doctor $doctor)
    {
        $doctor->load(['user', 'qualification']);
        $user = $doctor->user;
        $qualification = $doctor->qualification;

        $validated = Validator::make($request->all(), [
            // basic info for user
            'name'       => 'required|string|max:255',
            'email'      => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone'      => 'required|string|max:50',
            'dob'        => 'required|date',
            'gender'     => 'required|string|max:10',
            'address'    => 'required|string|max:255',
            'city'       => 'required|string|max:100',
            'state'      => 'required|string|max:100',
            'zipcode'    => 'required|string|max:20',

            // doctor relations
            'hospital_id'        => 'required|exists:hospitals,id',
            'department_id'      => 'required|exists:departments,id',
            'speciality_hours'   => 'required|string|max:255',
            'working_hours_from' => 'required|string|max:50',
            'working_hours_to'   => 'required|string|max:50',

            // qualification
            'degree'              => 'required|string|max:255',
            'institute'           => 'required|string|max:255',
            'start_date'          => 'required|date',
            'end_date'            => 'required|date|after_or_equal:start_date',
            'total_marks_CGPA'    => 'required|string|max:50',
            'achieved_marks_CGPA' => 'required|string|max:50',
            // attachment is OPTIONAL on update
            'attachment'          => 'nullable|file|mimes:pdf|max:4096',
        ]);

        if ($validated->fails()) {
            Log::error('Doctor update validation failed', [
                'errors' => $validated->errors()->toArray(),
                'input'  => $request->all(),
            ]);

            return back()
                ->withErrors($validated)
                ->withInput();
        }

        $validated = $validated->validated();

        try {
            DB::beginTransaction();

            // ========== UPDATE USER ==========
            $user->update([
                'name'    => $validated['name'],
                'email'   => $validated['email'],
                'phone'   => $validated['phone'] ?? null,
                'dob'     => $validated['dob'] ?? null,
                'gender'  => $validated['gender'] ?? null,
                'address' => $validated['address'] ?? null,
                'city'    => $validated['city'] ?? null,
                'state'   => $validated['state'] ?? null,
                'zipcode' => $validated['zipcode'] ?? null,
            ]);

            // ========== UPDATE DOCTOR ==========
            $doctor->update([
                'hospital_id'        => $validated['hospital_id'],
                'department_id'      => $validated['department_id'],
                'speciality_hours'   => $validated['speciality_hours'] ?? null,
                'working_hours_from' => $validated['working_hours_from'] ?? null,
                'working_hours_to'   => $validated['working_hours_to'] ?? null,
            ]);

            // ========== HANDLE ATTACHMENT (BASE64) ==========
            if ($request->hasFile('attachment')) {
                $pdfData = base64_encode(
                    file_get_contents($request->file('attachment')->getRealPath())
                );
            } else {
                // keep old attachment if exists
                $pdfData = $qualification ? $qualification->attachment : null;
            }

            // ========== UPDATE / CREATE QUALIFICATION ==========
            if ($qualification) {
                $qualification->update([
                    'degree'              => $validated['degree'] ?? null,
                    'institute'           => $validated['institute'] ?? null,
                    'start_date'          => $validated['start_date'] ?? null,
                    'end_date'            => $validated['end_date'] ?? null,
                    'total_marks_CGPA'    => $validated['total_marks_CGPA'] ?? null,
                    'achieved_marks_CGPA' => $validated['achieved_marks_CGPA'] ?? null,
                    'attachment'          => $pdfData,
                    'hospital_id'         => $validated['hospital_id'],
                    'user_id'             => $user->id,
                ]);
            } else {
                Qualification::create([
                    'degree'              => $validated['degree'] ?? null,
                    'institute'           => $validated['institute'] ?? null,
                    'start_date'          => $validated['start_date'] ?? null,
                    'end_date'            => $validated['end_date'] ?? null,
                    'total_marks_CGPA'    => $validated['total_marks_CGPA'] ?? null,
                    'achieved_marks_CGPA' => $validated['achieved_marks_CGPA'] ?? null,
                    'attachment'          => $pdfData,
                    'hospital_id'         => $validated['hospital_id'],
                    'doctor_id'           => $doctor->id,
                    'user_id'             => $user->id,
                ]);
            }

            DB::commit();

            return redirect("admin/hospital/detail/{$validated['hospital_id']}#doctor");
            flash('success', 'Doctor updated successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Doctor update failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withInput()->with('error', 'An error occurred while updating the doctor. Please try again.');
        }
    }

    public function destroy_doctor($doctor)
    {
        $doctor = Doctor::findOrFail($doctor);
        $hospitalId = $doctor->hospital_id;
        $doctor->delete();

        flash()->success('Doctor deleted successfully!');
        return redirect("admin/hospital/detail/{$hospitalId}#doctor");
    }


    public function add_nurse()
    {
        // Hospitals for dropdown (show hospital user->name)
        $hospitals = Hospital::with('user:id,name')->select('id','user_id')->get();

        // If you want to show all departments upfront:
        $departments = Department::select('id','name','hospital_id')->get();

        return view('admin.hospital.tabs.nurse.create', compact('hospitals','departments'));
    }

    public function store_nurse(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            // Users table (basic)
            'name'      => ['required','string','max:255'],
            'email'     => ['required','email','max:255','unique:users,email'],
            'phone'     => ['nullable','string','max:50'],
            'dob'       => ['nullable','date'],
            'gender'    => ['nullable','in:Male,Female,Other'],
            'address'   => ['nullable','string','max:500'],
            'city'      => ['nullable','string','max:100'],
            'state'     => ['nullable','string','max:100'],
            'zipcode'   => ['nullable','string','max:20'],

            // Relations
            'hospital_id'   => ['required','exists:hospitals,id'],
            'department_id' => ['required','exists:departments,id'],

            // Nurses table
            'working_hours' => ['nullable','string','max:255'],

            // Qualification (single row per your UI)
            'degree'                 => ['nullable','string','max:255'],
            'institute'              => ['nullable','string','max:255'],
            'start_date'             => ['nullable','date'],
            'end_date'               => ['nullable','date','after_or_equal:start_date'],
            'total_marks_CGPA'       => ['nullable','string','max:50'],
            'achieved_marks_CGPA'    => ['nullable','string','max:50'],
            'attachment'             => ['nullable','file','mimes:pdf,jpg,jpeg,png','max:4096'],
        ]);

        DB::transaction(function () use ($data, $request) {
            //  Create User for the nurse
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'phone'    => $data['phone'] ?? null,
                'dob'      => $data['dob'] ?? null,
                'gender'   => $data['gender'] ?? null,
                'address'  => $data['address'] ?? null,
                'city'     => $data['city'] ?? null,
                'state'    => $data['state'] ?? null,
                'zipcode'  => $data['zipcode'] ?? null,
                'password' => bcrypt(str()->random(16)), // placeholder password
            ]);

            // Create Nurse
            $nurse = Nurse::create([
                'working_hours' => $data['working_hours'] ?? null,
                'user_id'       => $user->id,
                'hospital_id'   => (int)$data['hospital_id'],
                'department_id' => (int)$data['department_id'],
            ]);

            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment');
                $attachmentPath = base64_encode(file_get_contents($attachmentPath->getRealPath()));
            }else{
                $attachmentPath = null;
            }

            // Only create qualification if at least one field is present
            if (
                ($data['degree'] ?? null) ||
                ($data['institute'] ?? null) ||
                ($data['start_date'] ?? null) ||
                ($data['end_date'] ?? null) ||
                ($data['total_marks_CGPA'] ?? null) ||
                ($data['achieved_marks_CGPA'] ?? null) ||
                $attachmentPath
            ) {
                Qualification::create([
                    'degree'               => $data['degree'] ?? null,
                    'institute'            => $data['institute'] ?? null,
                    'start_date'           => $data['start_date'] ?? null,
                    'end_date'             => $data['end_date'] ?? null,
                    'total_marks_CGPA'     => $data['total_marks_CGPA'] ?? null,
                    'achieved_marks_CGPA'  => $data['achieved_marks_CGPA'] ?? null,
                    'attachment'           => $attachmentPath,
                    'nurse_id'             => $nurse->id,
                    'user_id'              => $user->id,
                ]);
            }
        });
        return redirect("admin/hospital/detail/{$data['hospital_id']}#nurses");
        flash()->success('Nurse created successfully!');
    }
    

    public function nurse_view($id)
    {
        $nurse = Nurse::with('user', 'department', 'hospital.user', 'qualifications')->find($id);
        if (!$nurse) {
            return redirect()->back()->with('error', 'Nurse not found');
        }
        return view('admin.hospital.tabs.nurse.view', compact('nurse'));
    }

    public function getNurseDepartments($id)
    {
        $departments = Department::where('hospital_id', $id)->get(['id', 'name']);
        return response()->json($departments);
    }

    public function create_receptionist()    
    {
        $roles = Role::query()
            ->where('guard_name', 'web')
            ->whereIn('name', ['Receptionist','Admin','Nurse'])
            ->orderBy('name')
            ->get(['id','name']);
        $hospitals = Hospital::with('user:id,name')->select('id', 'user_id')->get();
        return view('admin.hospital.tabs.receptionist.create', compact('hospitals', 'roles'));
    }

    public function store_receptionist(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'email:rfc,dns', 'max:255', 'unique:users,email'],
            'phone'       => ['required', 'string'],
            'dob'         => ['required', 'date'],
            'gender'      => ['nullable', Rule::in(['Male','Female','Other'])],
            'hospital_id' => ['required', Rule::exists('hospitals', 'id')],
            'role_id'     => ['required',Rule::exists('roles', 'id')->where(fn ($q) =>$q->whereIn('name', ['Receptionist','Admin','Nurse']))],
        ]);
        if ($validator->fails()) {
            Log::error("Receptionist store validation error", ['error' => $validator->errors()->toArray(), 'input' => $request->all()]);
            return back()->withErrors($validator)->withInput();
        }
        $data = $validator->validated();
        try {
            DB::transaction(function () use ($data, $request) {
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'phone'    => $data['phone'],
                'dob'      => $data['dob'],
                'gender'   => $data['gender'],
                'password' =>Hash::make('123456789'),
            ]);

            $roleName = Role::findOrFail($data['role_id'])->name;
            $user->assignRole($roleName);

            Receptionist::create([
                'hospital_id' => $data['hospital_id'],
                'user_id'     => $user->id,
            ]);
        });
            return redirect("admin/hospital/detail/{$data['hospital_id']}#receptionists");
            flash()->success('Receptionist saved successfully!');
        } catch (\Throwable $th) {
            Log::error("Receptionist store failed", ['error' => $th->getMessage(), 'input' => $request->all()]);
            return back()->withInput()->with('error', 'Failed to create Receptionist. Please try again later!');
        }
            
    }

    public function view_receptionist($id)
    {
        $receptionist = Receptionist::with('user', 'hospital.user')->findOrFail($id);
        if (!$receptionist) {
            return redirect()->back()->with('error', 'Receptionist not found');
        }
        return view('admin.hospital.tabs.receptionist.view', compact('receptionist'));
    }

    public function create_pharmacist()
    {
        $hospitals = Hospital::with('user:id,name')->select('id', 'user_id')->get();
        $departments = Department::select('id', 'name', 'hospital_id')->get();

        return view('admin.hospital.tabs.pharmacist.create', compact('hospitals', 'departments'));
    }

    public function store_pharmacist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'unique:users,email'],
            'phone'         => ['nullable','string','max:50'],
            'dob'           => ['nullable','date'],
            'gender'        => ['nullable','in:Male,Female,Other'],
            'address'       => ['nullable','string','max:500'],
            'city'          => ['nullable','string','max:100'],
            'state'         => ['nullable','string','max:100'],
            'zipcode'       => ['nullable','string','max:20'],
            'working_hours' => ['nullable','string','max:255'],
            'hospital_id'   => ['required','exists:hospitals,id'],
            'department_id' => ['required','exists:departments,id'],
            'degree'        => ['nullable','string','max:255'],
            'institute'     => ['nullable','string','max:255'],
            'start_date'    => ['nullable','date'],
            'end_date'      => ['nullable','date','after_or_equal:start_date'],
            'total_marks_CGPA'     => ['nullable','string','max:50'],
            'achieved_marks_CGPA'  => ['nullable','string','max:50'],
            'attachment'           => ['nullable','file','mimes:pdf'],
        ]);
        if ($validator->fails()) {
            Log::error("Pharmacist store validation error", [
                'error' => $validator->errors()->toArray(),
                'input' => $request->all()
            ]);
            return back()->withErrors($validator)->withInput();
        }
        $data = $validator->validated();
        try {
            DB::transaction(function() use ($data, $request) {
                $user = User::create([
                    'name'      => $data['name'],
                    'email'     => $data['email'],
                    'phone'     => $data['phone'],
                    'dob'       => $data['dob'],
                    'gender'    => $data['gender'],
                    'address'   => $data['address'],
                    'city'      => $data['city'],
                    'state'     => $data['state'],
                    'zipcode'   => $data['zipcode'],
                    'password'  => Hash::make('123456789'),
                ]);
                $pharmacist = Pharmacist::create([
                    'working_hours' => $data['working_hours'] ?? null,
                    'hospital_id'   => $data['hospital_id'],
                    'department_id' => $data['department_id'],
                    'user_id'       => $user->id
                ]);
                if ($request->hasFile('attachment')) {
                    $attachmentPath = $request->file('attachment');
                    $attachmentPath = base64_encode(file_get_contents($attachmentPath->getRealPath()));
                } else {
                    $attachmentPath = null;
                }
                if (
                    ($data['degree'] ?? null) ||
                    ($data['institute'] ?? null) ||
                    ($data['start_date'] ?? null) ||
                    ($data['end_date'] ?? null) ||
                    ($data['total_marks_CGPA'] ?? null) ||
                    ($data['achieved_marks_CGPA'] ?? null) ||
                    $attachmentPath
                ) {
                    Qualification::create([
                        'degree'               => $data['degree'] ?? null,
                        'institute'            => $data['institute'] ?? null,
                        'start_date'           => $data['start_date'] ?? null,
                        'end_date'             => $data['end_date'] ?? null,
                        'total_marks_CGPA'     => $data['total_marks_CGPA'] ?? null,
                        'achieved_marks_CGPA'  => $data['achieved_marks_CGPA'] ?? null,
                        'attachment'           => $attachmentPath,
                        'pharmacist_id'        => $pharmacist->id,
                        'user_id'              => $user->id,
                    ]);
                }
            });
            return redirect("/admin/hospital/detail/{$data['hospital_id']}#pharmacists");
            flash()->success('Pharmacist created successfully!');
        } catch (\Throwable $th) {
            Log::error("Pharmacist store failed", ['error' => $th->getMessage(), 'input' => $request->all()]);
            return back()->withInput()->with('error', 'Failed to create Pharmacist. Please try again later!');
        }
    }

    public function view_pharmacist($id)
    {
        $pharmacist = Pharmacist::with('user', 'department', 'hospital.user', 'qualification')->findOrFail($id);
        if (!$pharmacist) {
            return redirect()->back()-with('error', 'Pharmacist not found');
        }
        return view('admin.hospital.tabs.pharmacist.view', compact('pharmacist'));
    }

    public function getPharmacistDepartments($id)
    {
        $departments = Department::where('hospital_id', $id)->get(['id', 'name']);
        return response()->json($departments);
    }

    public function store_department(Request $request)
    {
        $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'name' => 'required|string|max:255',
        ]);

        Department::create([
            'hospital_id' => $request->hospital_id,
            'user_id' => Auth::id(),
            'name' => $request->name,
        ]);

        return back()->with('success', 'Department added successfully.');
    }

    public function edit_department($id)
    {
        $department = Department::findOrFail($id);
        return response()->json($department);
    }

    public function update_department(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($id);
        $department->update([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Department updated successfully.');
    }

    public function delete_department($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return back()->with('success', 'Department deleted successfully.');
    }

}
