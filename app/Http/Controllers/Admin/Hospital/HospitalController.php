<?php

namespace App\Http\Controllers\Admin\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        return view('admin.hospital.index');
    }

    public function addHospital()
    {
        return view('admin.hospital.add-hospital');
    }

    public function hospitalDetail()
    {
        return view('admin.hospital.hospital-detail');
    }
}
