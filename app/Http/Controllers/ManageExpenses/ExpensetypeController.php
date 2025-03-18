<?php

namespace App\Http\Controllers\ManageExpenses;

use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class ExpensetypeController extends Controller
{
    public function show($categoryId)
{
    $category = ExpenseCategory::findOrFail($categoryId);
    $items = $category->items; 

    return view('pages.manage-expensetypes.expensetypes', compact('category', 'items'));
}
    public function index()
    {
        return view('pages.manage-expensetypes.expensetypes');
    }
}
