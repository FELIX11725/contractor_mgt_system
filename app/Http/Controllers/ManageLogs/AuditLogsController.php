<?php

namespace App\Http\Controllers\ManageLogs;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class AuditLogsController extends Controller
{
    public function index(): View
    {
        return view('pages.manage-logs.auditlogs');
    }

  
}
