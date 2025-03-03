<?php

namespace App\Http\Controllers\BudgetManagement;

use App\Models\Project;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BudgetController extends Controller
{
    protected $pdf;

    public function __construct(PDF $pdf)
    {
        $this->pdf = $pdf;
    }

    public function download($projectId)
    {
        $project = Project::findOrFail($projectId);
        $this->pdf->loadView('pdf.budget', compact('project'));
        return $this->pdf->download('budget.pdf');
    }
    public function index()
    {
        return view('pages.budget-management.budgets');
    }
}
