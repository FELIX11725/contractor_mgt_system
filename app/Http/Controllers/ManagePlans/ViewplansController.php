<?php

namespace App\Http\Controllers\ManagePlans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewplansController extends Controller
{
    public function index()

    {
        return view('pages.manage-plans.view-plans');
    }
}
