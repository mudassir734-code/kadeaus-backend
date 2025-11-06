<?php

namespace App\Http\Controllers\Admin\Hospital;

use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HospitalDetailController extends Controller
{
    public function detail(Request $request)
    {
        $pid = $request->query('id'); // e.g., PID-03
        abort_unless($pid, 404);

        // Load hospital by PID string, then use its numeric PK to fetch doctors
        $hospital = Hospital::with(['user'])
            ->where('hospital_id', $pid)
            ->firstOrFail();

        $doctors = Doctor::with(['user','department'])
            ->where('hospital_id', $hospital->id) // numeric FK
            ->latest()
            ->get();

        return view('admin.hospital.hospital-detail', compact('hospital','doctors'));
    }

    public function view($id)
    {
        $doctor = Doctor::with('user', 'department', 'hospital.user', 'qualification')->find($id);
        if (!$doctor) {
            return redirect()->back()->with('error', 'Doctor not found');
        }

        return view('admin.hospital.tabs.doctor.view', compact('doctor'));
    }
}
