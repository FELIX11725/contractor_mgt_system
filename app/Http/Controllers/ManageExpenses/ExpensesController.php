<?php

namespace App\Http\Controllers\ManageExpenses;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index():View
    {
        return view('pages.manage-expensetypes.expenses');
    }
}
