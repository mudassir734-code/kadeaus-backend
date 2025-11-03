<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function addUser()
    {
        return view('admin.users.add-users');
    }

    public function viewUser()
    {
        return view('admin.users.view-user');
    }
}
