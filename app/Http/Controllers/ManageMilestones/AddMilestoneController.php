<?php

namespace App\Http\Controllers\ManageMilestones;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class AddMilestoneController extends Controller
{
    public function index(): View{
        return view('pages.milestones.addmilestone');
        }
}
