<?php

namespace App\Http\Controllers\Admin\Hospital;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\User;

class HospitalController extends Controller
{
   public function index()
    {
        // Pull hospitals with linked user and appointment count
        $hospitals = Hospital::query()
            ->with(['user:id,name,email,phone'])      // eager-load basics
            // ->withCount('appointments')               // requires appointments() relation
            ->latest('id')
            ->get(['id','hospital_id','user_id','specialities']);

        return view('admin.hospital.index', compact('hospitals'));
    }

    public function create()
    {
        return view('admin.hospital.add-hospital');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // user fields (ALL basic info saved in users)
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email','max:255'],
            'phone'    => ['nullable','string','max:50'],
            'address'  => ['nullable','string','max:500'],
            'city'     => ['nullable','string','max:100'],
            'state'    => ['nullable','string','max:100'],
            'zipcode'  => ['nullable','string','max:20'],

            // hospital
            'specialities' => ['required','string','max:500'],

            // departments (optional)
            'departments'   => ['nullable','array'],
            'departments.*' => ['nullable','string','max:255'],
        ]);
        DB::transaction(function () use ($data) {
            // Upsert basic info into users
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name'     => $data['name'],
                    'email'    => $data['email'],
                    'phone'    => $data['phone'] ?? null,
                    'address'  => $data['address'] ?? null,
                    'city'     => $data['city'] ?? null,
                    'state'    => $data['state'] ?? null,
                    'zipcode'  => $data['zipcode'] ?? null,
                    'password' => bcrypt(str()->random(16)), // if required in schema
                ]
            );

            // Generate a unique PID like PID-01 in a concurrency-safe way
            $nextPid = $this->nextHospitalPid();

            // Create hospital with the generated PID
            $hospital = Hospital::create([
                'hospital_id'  => $nextPid,
                'user_id'      => $user->id,
                'specialities' => $data['specialities'],
            ]);

            // Departments (optional)
            $deps = collect($data['departments'] ?? [])
                ->filter(fn ($d) => filled($d))
                ->map(fn ($d) => ['name' => $d])
                ->values()
                ->all();

            if (!empty($deps)) {
                $hospital->departments()->createMany($deps);
            }
        });

        return redirect()->route('admin.hospital')->with('success', 'Record saved successfully.');
    }

    public function view($id)
    {
        $hospitalId =decrypt($id);
        $hospital = Hospital::with('user')->findOrFail($hospitalId);
        return view('admin.hospital.hospital-detail', compact('hospital'));
    }

    public function edit($id)
    {
         $hId = decrypt($id);
        $hospital = Hospital::with(['user', 'departments'])->findOrFail($hId);
        return view('admin.hospital.edit-hospital', compact('hospital'));
    }

 public function update(Request $request, $id)
{
    $data = $request->validate([
        // user fields
        'name'     => ['required','string','max:255'],
        'email'    => ['required','email','max:255'],
        'phone'    => ['nullable','string','max:50'],
        'address'  => ['nullable','string','max:500'],
        'city'     => ['nullable','string','max:100'],
        'state'    => ['nullable','string','max:100'],
        'zipcode'  => ['nullable','string','max:20'],

        // hospital
        'specialities' => ['required','string','max:500'],

        // departments with IDs for updating existing ones
        'department_ids'   => ['nullable','array'],
        'department_ids.*' => ['nullable','integer','exists:departments,id'],
        'departments'      => ['nullable','array'],
        'departments.*'    => ['nullable','string','max:255'],
    ]);

    DB::transaction(function () use ($data, $id) {
        $hospital = Hospital::findOrFail($id);
        $user = $hospital->user;

        // Update user info
        $user->update([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'address'  => $data['address'] ?? null,
            'city'     => $data['city'] ?? null,
            'state'    => $data['state'] ?? null,
            'zipcode'  => $data['zipcode'] ?? null,
        ]);

        // Update hospital info
        $hospital->update([
            'specialities' => $data['specialities'],
        ]);

        // Handle departments intelligently
        $submittedDepartmentIds = collect($data['department_ids'] ?? [])->filter()->values();
        $submittedDepartments = collect($data['departments'] ?? [])->filter(fn($d) => filled($d))->values();

        // Get existing department IDs for this hospital
        $existingDepartmentIds = $hospital->departments()->pluck('id');

        // Delete departments that were removed (not in submitted IDs)
        $hospital->departments()
            ->whereNotIn('id', $submittedDepartmentIds)
            ->delete();

        // Update or create departments
        foreach ($submittedDepartments as $index => $deptName) {
            $deptId = $submittedDepartmentIds->get($index);

            if ($deptId && $existingDepartmentIds->contains($deptId)) {
                // Update existing department
                $hospital->departments()->where('id', $deptId)->update(['name' => $deptName]);
            } else {
                // Create new department
                $hospital->departments()->create(['name' => $deptName]);
            }
        }
    });

    return redirect()->route('admin.hospital')->with('success', 'Record updated successfully.');
}

    public function destroy(Request $request)
    {
        // $hospital = Hospital::where('hospital_id', $hospital_id)->firstOrFail();
        // $hospital->delete();

        // return response()->json(['success' => true, 'message' => 'Hospital deleted successfully']);
         try {
        $hospital = Hospital::findOrFail($request->id);
        // delete related data
        $hospital->departments()->delete();

        // delete user if needed
        if ($hospital->user) {
            $hospital->user->delete();
        }

        // delete nurse
        $hospital->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Nurse and all related data deleted successfully!',
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong: ' . $e->getMessage()
        ]);
    }
    }

    protected function nextHospitalPid(): string
    {
        // Lock the table scope by touching the hospitals table in the outer transaction.
        // We read the last numeric part and increment.
        $last = Hospital::query()
            ->whereNotNull('hospital_id')
            ->lockForUpdate()
            ->orderByDesc('id')
            ->value('hospital_id'); // e.g., "PID-09"

        $nextNumber = 1;
        if ($last && preg_match('/^PID-(\d+)$/', $last, $m)) {
            $nextNumber = (int)$m[1] + 1;
        }

        // Pad to at least 2 digits; change to 3 if you prefer.
        return 'PID-' . str_pad((string)$nextNumber, 2, '0', STR_PAD_LEFT);
    }
}
