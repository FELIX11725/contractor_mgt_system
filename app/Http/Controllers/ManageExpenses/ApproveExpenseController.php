<?php

namespace App\Http\Controllers\ManageExpenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApproveExpenseController extends Controller
{
    public function index()
    {
        return view('pages.manage-expensetypes.approve-expense');
    }
}
