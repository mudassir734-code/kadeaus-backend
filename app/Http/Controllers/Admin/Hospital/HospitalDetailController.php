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

            case 'patients':
                $patients = Patient::with(['user', 'hospital.user'])
                    ->where('hospital_id', $hospital->id)
                    ->latest()
                    ->get();
                return view('admin.hospital.tabs.appointments.list', compact('patients', 'hospital'));

            case 'departments':
                $departments = Department::where(['hospital_id' => $hospital->id])
                    ->withCount('doctors', 'nurses')
                    ->get();
                return view('admin.hospital.tabs.department.list', compact('departments', 'hospital'));

            case 'laboratories':
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
    function nurseFilter(Request $request)
    {

        $search = $request->input('query');
        $hospitalId = $request->input('hospital_id');
        $hospital = Hospital::findOrFail($hospitalId);

        $nurses = Nurse::with(['user', 'department', 'hospital.user', 'qualifications'])
            ->where('hospital_id', $hospitalId)
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    });
                });
            })
            ->latest()
            ->get();

        return view('admin.hospital.tabs.nurse.filter', compact('nurses', 'hospital'));
    }

    public function add_nurse()
    {
        // Hospitals for dropdown (show hospital user->name)
        $hospitals = Hospital::with('user:id,name')->select('id', 'user_id')->get();

        // If you want to show all departments upfront:
        $departments = Department::select('id', 'name', 'hospital_id')->get();

        return view('admin.hospital.tabs.nurse.create', compact('hospitals', 'departments'));
    }

    public function store_nurse(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            // Users table (basic)
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone'     => ['nullable', 'string', 'max:50'],
            'dob'       => ['nullable', 'date'],
            'gender'    => ['nullable', 'in:Male,Female,Other'],
            'address'   => ['nullable', 'string', 'max:500'],
            'city'      => ['nullable', 'string', 'max:100'],
            'state'     => ['nullable', 'string', 'max:100'],
            'zipcode'   => ['nullable', 'string', 'max:20'],

            // Relations
            'hospital_id'   => ['required', 'exists:hospitals,id'],
            'department_id' => ['required', 'exists:departments,id'],

            // Nurses table
            'working_hours' => ['nullable', 'string', 'max:255'],

            // Qualification (multiple rows – arrays)
            'degree'                 => ['nullable', 'array'],
            'degree.*'               => ['nullable', 'string', 'max:255'],

            'institute'              => ['nullable', 'array'],
            'institute.*'            => ['nullable', 'string', 'max:255'],

            'start_date'             => ['nullable', 'array'],
            'start_date.*'           => ['nullable', 'date'],

            'end_date'               => ['nullable', 'array'],
            'end_date.*'             => ['nullable', 'date'], // if you want after_or_equal logic, handle it manually

            'total_marks_CGPA'       => ['nullable', 'array'],
            'total_marks_CGPA.*'     => ['nullable', 'string', 'max:50'],

            'achieved_marks_CGPA'    => ['nullable', 'array'],
            'achieved_marks_CGPA.*'  => ['nullable', 'string', 'max:50'],

            'attachment'             => ['nullable', 'array'],
            'attachment.*'           => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:4096'],
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

            //  Multiple qualifications logic
            $degrees              = $request->input('degree', []);
            $institutes           = $request->input('institute', []);
            $startDates           = $request->input('start_date', []);
            $endDates             = $request->input('end_date', []);
            $totalMarksOrCgpa     = $request->input('total_marks_CGPA', []);
            $achievedMarksOrCgpa  = $request->input('achieved_marks_CGPA', []);
            $attachments          = $request->file('attachment', []); // array of UploadedFile

            foreach ($degrees as $index => $degree) {
                $institute          = $institutes[$index]          ?? null;
                $startDate          = $startDates[$index]          ?? null;
                $endDate            = $endDates[$index]            ?? null;
                $totalMarks         = $totalMarksOrCgpa[$index]    ?? null;
                $achievedMarks      = $achievedMarksOrCgpa[$index] ?? null;
                $file               = $attachments[$index]         ?? null;

                // Skip completely empty rows
                if (
                    empty($degree) &&
                    empty($institute) &&
                    empty($startDate) &&
                    empty($endDate) &&
                    empty($totalMarks) &&
                    empty($achievedMarks) &&
                    !$file
                ) {
                    continue;
                }

                // Handle file -> base64
                $attachmentPath = null;
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $attachmentPath = base64_encode(file_get_contents($file->getRealPath()));
                }

                Qualification::create([
                    'degree'               => $degree ?: null,
                    'institute'            => $institute ?: null,
                    'start_date'           => $startDate ?: null,
                    'end_date'             => $endDate ?: null,
                    'total_marks_CGPA'     => $totalMarks ?: null,
                    'achieved_marks_CGPA'  => $achievedMarks ?: null,
                    'attachment'           => $attachmentPath,
                    'nurse_id'             => $nurse->id,
                    'user_id'              => $user->id,
                ]);
            }
        });

        $hospitalID = encrypt($data['hospital_id']);
        flash()->success('Nurse created successfully!');
        return redirect("admin/hospital/detail/{$hospitalID}#nurses");
    }



    public function nurse_view($id)
    {
        $nurseID = decrypt($id);
        $nurse = Nurse::with('user', 'department', 'hospital.user', 'qualifications')->find($nurseID);
        if (!$nurse) {
            return redirect()->back()->with('error', 'Nurse not found');
        }
        return view('admin.hospital.tabs.nurse.view', compact('nurse'));
    }
    public function nurseEdit($id)
    {
        $nurseID = decrypt($id);
        $nurse = Nurse::with('user', 'department', 'hospital.user', 'qualifications')->find($nurseID);
        if (!$nurse) {
            return redirect()->back()->with('error', 'Nurse not found');
        }
        // Hospitals for dropdown (show hospital user->name)
        $hospitals = Hospital::with('user:id,name')->select('id', 'user_id')->get();
        // If you want to show all departments upfront:
        $departments = Department::select('id', 'name', 'hospital_id')->get();
        return view('admin.hospital.tabs.nurse.edit', compact('nurse', 'hospitals', 'departments'));
    }

    public function storeUpdate(Request $request)
    {
        $nurseID = decrypt($request->id);
        $nurse = Nurse::with(['user', 'qualifications'])->findOrFail($nurseID);
        $user  = $nurse->user;

        $data = $request->validate([
            // Users
            'name'      => ['required', 'string', 'max:255'],
            'email'     => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone'     => ['nullable', 'string', 'max:50'],
            'dob'       => ['nullable', 'date'],
            'gender'    => ['nullable', 'in:Male,Female,Other'],
            'address'   => ['nullable', 'string', 'max:500'],
            'city'      => ['nullable', 'string', 'max:100'],
            'state'     => ['nullable', 'string', 'max:100'],
            'zipcode'   => ['nullable', 'string', 'max:20'],

            // Relations
            'hospital_id'   => ['required', 'exists:hospitals,id'],
            'department_id' => ['required', 'exists:departments,id'],

            // Nurse
            'working_hours' => ['nullable', 'string', 'max:255'],

            // Qualification – arrays
            'qualification_id'       => ['nullable', 'array'],
            'qualification_id.*'     => ['nullable', 'integer', 'exists:qualifications,id'],

            'degree'                 => ['nullable', 'array'],
            'degree.*'               => ['nullable', 'string', 'max:255'],

            'institute'              => ['nullable', 'array'],
            'institute.*'            => ['nullable', 'string', 'max:255'],

            'start_date'             => ['nullable', 'array'],
            'start_date.*'           => ['nullable', 'date'],

            'end_date'               => ['nullable', 'array'],
            'end_date.*'             => ['nullable', 'date'],

            'total_marks_CGPA'       => ['nullable', 'array'],
            'total_marks_CGPA.*'     => ['nullable', 'string', 'max:50'],

            'achieved_marks_CGPA'    => ['nullable', 'array'],
            'achieved_marks_CGPA.*'  => ['nullable', 'string', 'max:50'],

            'attachment'             => ['nullable', 'array'],
            'attachment.*'           => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:4096'],
        ]);

        DB::transaction(function () use ($data, $request, $nurse, $user) {

            // ✅ Update user
            $user->update([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'phone'    => $data['phone'] ?? null,
                'dob'      => $data['dob'] ?? null,
                'gender'   => $data['gender'] ?? null,
                'address'  => $data['address'] ?? null,
                'city'     => $data['city'] ?? null,
                'state'    => $data['state'] ?? null,
                'zipcode'  => $data['zipcode'] ?? null,
            ]);

            //  Update nurse
            $nurse->update([
                'working_hours' => $data['working_hours'] ?? null,
                'hospital_id'   => (int) $data['hospital_id'],
                'department_id' => (int) $data['department_id'],
            ]);

            //  Qualifications
            $ids                = $request->input('qualification_id', []);
            $degrees            = $request->input('degree', []);
            $institutes         = $request->input('institute', []);
            $startDates         = $request->input('start_date', []);
            $endDates           = $request->input('end_date', []);
            $totalMarksOrCgpa   = $request->input('total_marks_CGPA', []);
            $achievedMarksOrCgpa = $request->input('achieved_marks_CGPA', []);
            $attachments        = $request->file('attachment', []);

            // For deletion: which IDs are still in form?
            $submittedIds = array_filter($ids); // non-empty

            // Delete qualifications that were removed from the form
            $idsToDelete = $nurse->qualifications
                ->whereNotIn('id', $submittedIds)
                ->pluck('id')
                ->all();

            if (!empty($idsToDelete)) {
                Qualification::whereIn('id', $idsToDelete)->delete();
            }

            // Handle create / update
            foreach ($degrees as $index => $degree) {

                $qualificationId = $ids[$index] ?? null;
                $institute       = $institutes[$index]          ?? null;
                $startDate       = $startDates[$index]          ?? null;
                $endDate         = $endDates[$index]            ?? null;
                $totalMarks      = $totalMarksOrCgpa[$index]    ?? null;
                $achievedMarks   = $achievedMarksOrCgpa[$index] ?? null;
                $file            = $attachments[$index]         ?? null;

                // Skip completely empty rows
                if (
                    empty($qualificationId) &&
                    empty($degree) &&
                    empty($institute) &&
                    empty($startDate) &&
                    empty($endDate) &&
                    empty($totalMarks) &&
                    empty($achievedMarks) &&
                    !$file
                ) {
                    continue;
                }

                // Existing qualification?
                $qualification = null;
                if (!empty($qualificationId)) {
                    $qualification = $nurse->qualifications->firstWhere('id', (int)$qualificationId);
                }

                // Attachment: keep old unless new file uploaded
                $attachmentPath = $qualification?->attachment;

                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $attachmentPath = $file->store('nurse_qualifications', 'public');
                }

                $payload = [
                    'degree'               => $degree ?: null,
                    'institute'            => $institute ?: null,
                    'start_date'           => $startDate ?: null,
                    'end_date'             => $endDate ?: null,
                    'total_marks_CGPA'     => $totalMarks ?: null,
                    'achieved_marks_CGPA'  => $achievedMarks ?: null,
                    'attachment'           => $attachmentPath,
                    'nurse_id'             => $nurse->id,
                    'user_id'              => $user->id,
                ];

                if ($qualification) {
                    $qualification->update($payload);
                } else {
                    Qualification::create($payload);
                }
            }
        });

        $hospitalID = encrypt($nurse->hospital_id);
        flash()->success('Nurse updated successfully!');
        return redirect("admin/hospital/detail/{$hospitalID}#nurses");
    }

    public function nurseDelete(Request $request)
    {
        try {
            $nurse = Nurse::findOrFail($request->id);
            // delete related data
            $nurse->qualifications()->delete();

            // delete user if needed
            if ($nurse->user) {
                $nurse->user->delete();
            }

            $hospitalID = encrypt($nurse->hospital_id); // encrypt hospital ID
            $redirectUrl = url("admin/hospital/detail/{$hospitalID}#nurses");

            // delete nurse
            $nurse->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Nurse and all related data deleted successfully!',
                'redirect_url' => $redirectUrl
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
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
            ->whereIn('name', ['Receptionist', 'Admin', 'Nurse'])
            ->orderBy('name')
            ->get(['id', 'name']);
        $hospitals = Hospital::with('user:id,name')->select('id', 'user_id')->get();
        return view('admin.hospital.tabs.receptionist.create', compact('hospitals', 'roles'));
    }

    public function storeReceptionist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'email:rfc,dns', 'max:255', 'unique:users,email'],
            'phone'       => ['required', 'string'],
            'dob'         => ['required', 'date'],
            'gender'      => ['nullable', Rule::in(['Male', 'Female', 'Other'])],
            'hospital_id' => ['required', Rule::exists('hospitals', 'id')],
            'role_id'     => ['required', Rule::exists('roles', 'id')->where(fn($q) => $q->whereIn('name', ['Receptionist', 'Admin', 'Nurse']))],
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
                    'password' => Hash::make('123456789'),
                ]);

                $roleName = Role::findOrFail($data['role_id'])->name;
                $user->assignRole($roleName);

                Receptionist::create([
                    'hospital_id' => $data['hospital_id'],
                    'user_id'     => $user->id,
                ]);
            });
            $hospitalID = encrypt($data['hospital_id']);
            return redirect("admin/hospital/detail/{$hospitalID}#receptionists");
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
    public function receptionistEdit($id)
    {
        $rId = decrypt($id);
        $receptionist = Receptionist::with('user', 'hospital.user')->findOrFail($rId);
            $roles = Role::whereIn('name', ['Receptionist', 'Admin', 'Nurse'])->get();
    $hospitals = Hospital::with('user')->get();

        if (!$receptionist) {
            return redirect()->back()->with('error', 'Receptionist not found');
        }
        return view('admin.hospital.tabs.receptionist.edit', compact('receptionist', 'roles', 'hospitals'));
    }
public function receptionistUpdate(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id'          => ['required', 'string'],
        'name'        => ['required', 'string', 'max:255'],
        'email'       => ['required', 'email:rfc,dns', 'max:255'],
        'phone'       => ['required', 'string'],
        'dob'         => ['required', 'date'],
        'gender'      => ['nullable', Rule::in(['Male', 'Female', 'Other'])],
        'hospital_id' => ['required', Rule::exists('hospitals', 'id')],
        'role_id'     => ['required', Rule::exists('roles', 'id')->where(fn($q) => $q->whereIn('name', ['Receptionist', 'Admin', 'Nurse']))],
    ]);

    if ($validator->fails()) {
        Log::error("Receptionist update validation error", [
            'error' => $validator->errors()->toArray(),
            'input' => $request->all()
        ]);
        return back()->withErrors($validator)->withInput();
    }

    $data = $validator->validated();

    try {
        // Decrypt the receptionist ID
        $receptionistId = decrypt($data['id']);

        DB::transaction(function () use ($data, $receptionistId) {
            // Find the receptionist
            $receptionist = Receptionist::findOrFail($receptionistId);
            $user = $receptionist->user;

            // Check if email is being changed and if it's unique
            if ($user->email !== $data['email']) {
                $emailExists = User::where('email', $data['email'])
                    ->where('id', '!=', $user->id)
                    ->exists();

                if ($emailExists) {
                    throw new \Exception('Email already exists');
                }
            }

            // Update user info
            $user->update([
                'name'   => $data['name'],
                'email'  => $data['email'],
                'phone'  => $data['phone'],
                'dob'    => $data['dob'],
                'gender' => $data['gender'],
            ]);

            // Update role if changed
            $newRole = Role::findOrFail($data['role_id']);
            $currentRoles = $user->roles->pluck('name')->toArray();

            if (!in_array($newRole->name, $currentRoles)) {
                // Remove old roles and assign new one
                $user->syncRoles([$newRole->name]);
            }

            // Update hospital if changed
            if ($receptionist->hospital_id !== $data['hospital_id']) {
                $receptionist->update([
                    'hospital_id' => $data['hospital_id'],
                ]);
            }
        });

        $hospitalID = encrypt($data['hospital_id']);
        flash()->success('Receptionist updated successfully!');
        return redirect("admin/hospital/detail/{$hospitalID}#receptionists");

    } catch (\Exception $e) {
        if ($e->getMessage() === 'Email already exists') {
            return back()->withInput()->with('error', 'Email address is already in use.');
        }

        Log::error("Receptionist update failed", [
            'error' => $e->getMessage(),
            'input' => $request->all()
        ]);
        return back()->withInput()->with('error', 'Failed to update Receptionist. Please try again later!');
    }
}

 function receptionistFilter(Request $request)
    {

        $search = $request->input('query');
        $hospitalId = $request->input('hospital_id');
        $hospital = Hospital::findOrFail($hospitalId);

        $receptionists = Receptionist::with(['user', 'hospital.user'])
            ->where('hospital_id', $hospitalId)
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    });
                });
            })
            ->latest()
            ->get();

        return view('admin.hospital.tabs.receptionist.filter', compact('receptionists', 'hospital'));
    }
    public function receptionistDelete(Request $request)
    {
        try {
            $nurse = Receptionist::findOrFail($request->id);
            // delete user if needed
            if ($nurse->user) {
                $nurse->user->delete();
            }

            $hospitalID = encrypt($nurse->hospital_id); // encrypt hospital ID
            $redirectUrl = url("admin/hospital/detail/{$hospitalID}#receptionists");

            // delete nurse
            $nurse->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Receptionist and all related data deleted successfully!',
                'redirect_url' => $redirectUrl
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
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
            'phone'         => ['nullable', 'string', 'max:50'],
            'dob'           => ['nullable', 'date'],
            'gender'        => ['nullable', 'in:Male,Female,Other'],
            'address'       => ['nullable', 'string', 'max:500'],
            'city'          => ['nullable', 'string', 'max:100'],
            'state'         => ['nullable', 'string', 'max:100'],
            'zipcode'       => ['nullable', 'string', 'max:20'],
            'working_hours' => ['nullable', 'string', 'max:255'],
            'hospital_id'   => ['required', 'exists:hospitals,id'],
            'department_id' => ['required', 'exists:departments,id'],
             // Qualification – arrays
            'qualification_id'       => ['nullable', 'array'],
            'qualification_id.*'     => ['nullable', 'integer', 'exists:qualifications,id'],

            'degree'                 => ['nullable', 'array'],
            'degree.*'               => ['nullable', 'string', 'max:255'],

            'institute'              => ['nullable', 'array'],
            'institute.*'            => ['nullable', 'string', 'max:255'],

            'start_date'             => ['nullable', 'array'],
            'start_date.*'           => ['nullable', 'date'],

            'end_date'               => ['nullable', 'array'],
            'end_date.*'             => ['nullable', 'date'],

            'total_marks_CGPA'       => ['nullable', 'array'],
            'total_marks_CGPA.*'     => ['nullable', 'string', 'max:50'],

            'achieved_marks_CGPA'    => ['nullable', 'array'],
            'achieved_marks_CGPA.*'  => ['nullable', 'string', 'max:50'],

            'attachment'             => ['nullable', 'array'],
            'attachment.*'           => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:4096'],
        ]);
        if ($validator->fails()) {
            Log::error("Pharmacist store validation error", [
                'error' => $validator->errors()->toArray(),
                'input' => $request->all()
            ]);
            return back()->withErrors($validator)->withInput();
        }
        $data = $validator->validated();
        // try {
            DB::transaction(function () use ($data, $request) {
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
             //  Multiple qualifications logic
            $degrees              = $request->input('degree', []);
            $institutes           = $request->input('institute', []);
            $startDates           = $request->input('start_date', []);
            $endDates             = $request->input('end_date', []);
            $totalMarksOrCgpa     = $request->input('total_marks_CGPA', []);
            $achievedMarksOrCgpa  = $request->input('achieved_marks_CGPA', []);
            $attachments          = $request->file('attachment', []); // array of UploadedFile

            foreach ($degrees as $index => $degree) {
                $institute          = $institutes[$index]          ?? null;
                $startDate          = $startDates[$index]          ?? null;
                $endDate            = $endDates[$index]            ?? null;
                $totalMarks         = $totalMarksOrCgpa[$index]    ?? null;
                $achievedMarks      = $achievedMarksOrCgpa[$index] ?? null;
                $file               = $attachments[$index]         ?? null;

                // Skip completely empty rows
                if (
                    empty($degree) &&
                    empty($institute) &&
                    empty($startDate) &&
                    empty($endDate) &&
                    empty($totalMarks) &&
                    empty($achievedMarks) &&
                    !$file
                ) {
                    continue;
                }

                // Handle file -> base64
                $attachmentPath = null;
                 if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $attachmentPath = $file->store('pharmacist_qualifications', 'public');
                }
                Qualification::create([
                    'degree'               => $degree ?: null,
                    'institute'            => $institute ?: null,
                    'start_date'           => $startDate ?: null,
                    'end_date'             => $endDate ?: null,
                    'total_marks_CGPA'     => $totalMarks ?: null,
                    'achieved_marks_CGPA'  => $achievedMarks ?: null,
                    'attachment'           => $attachmentPath,
                    'nurse_id'             => $pharmacist->id,
                    'user_id'              => $user->id,
                ]);
            }
            });
             $hospitalID = encrypt($data['hospital_id']); // encrypt hospital ID
            return redirect("/admin/hospital/detail/{$hospitalID}#pharmacists");
            flash()->success('Pharmacist created successfully!');
        // } catch (\Throwable $th) {
        //     Log::error("Pharmacist store failed", ['error' => $th->getMessage(), 'input' => $request->all()]);
        //     return back()->withInput()->with('error', 'Failed to create Pharmacist. Please try again later!');
        // }
    }

    public function view_pharmacist($id)
    {
        $pharmacist = Pharmacist::with('user', 'department', 'hospital.user', 'qualification')->findOrFail($id);
        if (!$pharmacist) {
            return redirect()->back() - with('error', 'Pharmacist not found');
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
