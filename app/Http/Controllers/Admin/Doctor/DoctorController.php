<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return view('admin.doctor.index');
    }

    public function addDoctor()
    {
        return view('admin.doctor.add-doctor');
    }

    public function viewDoctor()
    {
        return view('admin.doctor.view-doctor');
    }
}
