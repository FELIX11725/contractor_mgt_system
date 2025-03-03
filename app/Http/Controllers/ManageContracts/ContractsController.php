<?php

namespace App\Http\Controllers\ManageContracts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
    public function index()
    {
        return view('pages.manage-contracts.contracts');
    }
}
