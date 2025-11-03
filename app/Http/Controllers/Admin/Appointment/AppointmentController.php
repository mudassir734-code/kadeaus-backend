<?php

namespace App\Http\Controllers\Admin\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('admin.appointment.index');
    }

    public function viewDetail()
    {
        return view('admin.appointment.view-detail');
    }
}
