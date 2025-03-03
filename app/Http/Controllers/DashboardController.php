<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Expense;
use App\Models\Project;
use App\Models\Contractor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $activeProjectsCount = Project::where('project_status', 'active')->count();
        $totalExpenses = Expense::sum('amount_paid');
        $totalBudget = Budget::latest()->value('estimated_amount');
        $topContractors = Contractor::orderBy('work_experience', 'desc')->take(3)->get();
    
        // Monthly Expenses and Revenues
        $monthlyExpenses = Expense::selectRaw('MONTH(created_at) as month, SUM(amount_paid) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');
    
        $monthlyRevenues = Budget::selectRaw('MONTH(created_at) as month, SUM(estimated_amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');
    
        // Convert to a full 12-month structure (defaulting to 0 if no data exists)
        $expensesData = [];
        $revenuesData = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
        for ($i = 1; $i <= 12; $i++) {
            $expensesData[] = $monthlyExpenses[$i] ?? 0;
            $revenuesData[] = $monthlyRevenues[$i] ?? 0;
        }
    
        // Quarterly Profits and Losses
        $quarterlyProfits = [];
        $quarterlyLosses = [];
    
        for ($q = 0; $q < 4; $q++) {
            $startMonth = ($q * 3) + 1;
            $endMonth = $startMonth + 2;
    
            $quarterExpense = Expense::whereBetween('created_at', [now()->startOfYear()->addMonths($startMonth - 1), now()->startOfYear()->addMonths($endMonth - 1)->endOfMonth()])
                ->sum('amount_paid');
    
            $quarterRevenue = Budget::whereBetween('created_at', [now()->startOfYear()->addMonths($startMonth - 1), now()->startOfYear()->addMonths($endMonth - 1)->endOfMonth()])
                ->sum('estimated_amount');
    
            $profit = max($quarterRevenue - $quarterExpense, 0);
            $loss = max($quarterExpense - $quarterRevenue, 0);
    
            $quarterlyProfits[] = $profit;
            $quarterlyLosses[] = $loss;
        }
    
        return view('pages.dashboard.dashboard', compact(
            'activeProjectsCount',
            'totalExpenses',
            'totalBudget',
            'topContractors',
            'months',
            'expensesData',
            'revenuesData',
            'quarterlyProfits',
            'quarterlyLosses'
        ));
    }
    
}




