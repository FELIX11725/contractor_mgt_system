<?php

namespace App\Http\Controllers\ManageContracts;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AddContractController extends Controller

{
    public function index():View
    {
        return view('pages.manage-contracts.addcontract');
    }
}
