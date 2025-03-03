<?php

namespace App\Http\Controllers\ManageStaff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        return view('pages.manage-staff.staff');
    }
}
