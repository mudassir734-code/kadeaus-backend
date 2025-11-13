<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Qualification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with(['user', 'hospital.user', 'department'])->latest()->get();
        return view('admin.doctor.index', compact('doctors'));
    }

    public function create()
    {
        $hospitals   = Hospital::with('user:id,name')->get();
        $departments = Department::select('id', 'name')->get();
        return view('admin.doctor.add-doctor', compact('hospitals', 'departments'));
    }

    public function store(Request $request)
    {
         $validated = Validator::make($request->all(), [
            // basic info for user
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
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
            'degree'             => 'required|string|max:255',
            'institute'          => 'required|string|max:255',
            'start_date'         => 'required|date',
            'end_date'           => 'required|date|after_or_equal:start_date',
            'total_marks_CGPA'   => 'required|string|max:50',
            'achieved_marks_CGPA'=> 'required|string|max:50',
            'attachment'         => 'required|file|mimes:pdf|max:4096',
        ]);
        if ($validated->fails()) {
        Log::error('Doctor store validation failed', [
            'errors' => $validated->errors()->toArray(),
            'input'  => $request->all(),
        ]);

        return back()
            ->withErrors($validated)
            ->withInput();
    }

    // Continue if validation passes
    $validated = $validated->validated();

        try {
            DB::beginTransaction();

            // Create or update user
            $user = User::updateOrCreate(
                ['email' => $validated['email']],
                [
                    'name'     => $validated['name'],
                    'email'    => $validated['email'],
                    'phone'    => $validated['phone'] ?? null,
                    'dob'      => $validated['dob'] ?? null,
                    'gender'   => $validated['gender'] ?? null,
                    'address'  => $validated['address'] ?? null,
                    'city'     => $validated['city'] ?? null,
                    'state'    => $validated['state'] ?? null,
                    'zipcode'  => $validated['zipcode'] ?? null,
                    'password' => Hash::make('123456789'),
                ]
            );

            // Doctor creation
            $doctor = Doctor::create([
                'user_id'            => $user->id,
                'hospital_id'        => $validated['hospital_id'],
                'department_id'      => $validated['department_id'],
                'speciality_hours'   => $validated['speciality_hours'] ?? null,
                'working_hours_from' => $validated['working_hours_from'] ?? null,
                'working_hours_to'   => $validated['working_hours_to'] ?? null,
            ]);

            // Handle qualification PDF
            $pdfData = $request->hasFile('attachment')
                ? base64_encode(file_get_contents($request->file('attachment')->getRealPath()))
                : null;

            // Qualification creation
            if (!empty($validated['degree']) || !empty($validated['institute'])) {
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

            return redirect()
                ->route('admin.doctor')
                ->with('success', 'Doctor created successfully!');

        } catch (\Throwable $e) {
            DB::rollBack();

            // Optional: Log for debugging
            Log::error('Doctor creation failed: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'An error occurred while creating the doctor. Please try again.');
        }
    }

    public function viewDoctor()
    {
        return view('admin.doctor.view-doctor');
    }

    public function getDepartments($id)
    {
        $departments = Department::where('hospital_id', $id)->get(['id', 'name']);
        return response()->json($departments);
    }

}
