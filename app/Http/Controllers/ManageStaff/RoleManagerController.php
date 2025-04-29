<?php

namespace App\Http\Controllers\ManageStaff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleManagerController extends Controller
{
    public function index()
    {
        return view('pages.manage-staff.role-manager');
    }
}
