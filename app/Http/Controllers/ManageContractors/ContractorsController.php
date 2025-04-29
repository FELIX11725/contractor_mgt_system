<?php

namespace App\Http\Controllers\ManageContractors;

use App\Models\staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContractorsController extends Controller
{
    public function index()
    {
        return view('pages.manage-contractors.contractors');
    }
    public function showProfile(staff $staff)
{
    return view('contractors.profile', compact('staff'));
}

}
