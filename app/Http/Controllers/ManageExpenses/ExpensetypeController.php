<?php

namespace App\Http\Controllers\ManageExpenses;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class ExpensetypeController extends Controller
{
    public function index()
    {
        return view('pages.manage-expensetypes.expensetypes');
    }
}
