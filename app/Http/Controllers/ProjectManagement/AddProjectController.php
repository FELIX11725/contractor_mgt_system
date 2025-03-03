<?php

namespace App\Http\Controllers\ProjectManagement;


use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class AddProjectController extends Controller
{
    public function index(): View
    {
       
        return view('pages.project-management.addproject');
    }

  
}
