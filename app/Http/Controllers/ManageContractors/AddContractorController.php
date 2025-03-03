<?php

namespace App\Http\Controllers\ManageContractors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddContractorController extends Controller
{
    public function index()
    {
        return view('pages.manage-contractors.add-contractor');
    }
}
