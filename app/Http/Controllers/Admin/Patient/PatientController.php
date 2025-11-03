<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        return view('admin.patient.index');
    }

    public function viewPatient()
    {
        return view('admin.patient.view-patient');
    }
}
