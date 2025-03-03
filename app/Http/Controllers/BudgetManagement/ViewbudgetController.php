<?php

namespace App\Http\Controllers\BudgetManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewbudgetController extends Controller
{
    public function index()
    {
        return view('pages.budget-management.view-budget');
    }
}
