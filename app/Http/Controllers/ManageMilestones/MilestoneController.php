<?php

namespace App\Http\Controllers\ManageMilestones;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;


class MilestoneController extends Controller
{
    public function index(): View{
    return view('pages.milestones.milestones');
    }
}
