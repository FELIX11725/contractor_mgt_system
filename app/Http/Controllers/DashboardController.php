<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Budget;
use App\Models\BudgetItem;
use App\Models\Expense;
use App\Models\Project;
use App\Models\Contractor;

class DashboardController extends Controller
{
    public function index()
    {
        // Active projects count
        $activeProjectsCount = Project::all()->count();
        $totalContractors = Contractor::count();
        $availableContractors = Contractor::all()->count();
        $totalBudget = BudgetItem::sum('estimated_amount');
        $allocatedBudget = BudgetItem::whereHas('expenseCategoryItem', function($query) {
            $query->whereNotNull('id'); // Or any condition that shows it's allocated
        })->sum('estimated_amount');
        
        $budgetUtilization = $totalBudget > 0 
            ? round(($allocatedBudget / $totalBudget) * 100)
            : 0;


        $currentMonthExpenses = Expense::whereBetween('created_at', [
            now()->startOfMonth(),
            now()->endOfMonth()
        ])->sum('amount_paid');
        
        $previousMonthExpenses = Expense::whereBetween('created_at', [
            now()->subMonth()->startOfMonth(),
            now()->subMonth()->endOfMonth()
        ])->sum('amount_paid');
        
        $expensePercentageChange = $previousMonthExpenses > 0 
            ? round((($currentMonthExpenses - $previousMonthExpenses) / $previousMonthExpenses * 100), 1)
            : ($currentMonthExpenses > 0 ? 100 : 0);

             // Calculate percentage of budget used (if you have a monthly budget)
             $monthlyBudget = Budget::whereBetween('created_at', [
                now()->startOfMonth(),
                now()->endOfMonth()
            ])->sum('estimated_amount');
            
            $budgetPercentage = $monthlyBudget > 0 
                ? min(round(($currentMonthExpenses / $monthlyBudget) * 100), 100)
                : 0;

        $totalStaff = User::count(); // or Staff::count() if you have a separate model
       $newStaffThisMonth = User::where('created_at', '>=', now()->startOfMonth())
             ->where('created_at', '<=', now()->endOfMonth())
             ->count();
             $lastMonthStaffCount = User::where('created_at', '>=', now()->subMonth()->startOfMonth())
              ->where('created_at', '<=', now()->subMonth()->endOfMonth())
              ->count();

              $staffPercentageChange = $lastMonthStaffCount > 0 
               ? round((($totalStaff - $lastMonthStaffCount) / $lastMonthStaffCount) * 100, 1)
               : ($totalStaff > 0 ? 100 : 0);

        // Calculate percentage change from last month
          $lastMonthCount = Contractor::where('created_at', '>=', now()->subMonth()->startOfMonth())
          ->where('created_at', '<=', now()->subMonth()->endOfMonth())
          ->count();

          $contractorPercentageChange = $lastMonthCount > 0 
          ? round((($totalContractors - $lastMonthCount) / $lastMonthCount) * 100, 1)
          : ($totalContractors > 0 ? 100 : 0);

        
        // New projects this week
        $newProjectsThisWeek = Project::all()
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();
            
        // Projects from last week for comparison
        $lastWeekCount = Project::all()
            ->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
            ->count();
            
        // Percentage change calculation
        $percentageChange = $lastWeekCount > 0 
            ? round((($newProjectsThisWeek - $lastWeekCount) / $lastWeekCount) * 100, 1)
            : ($newProjectsThisWeek > 0 ? 100 : 0);

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
    
        // Convert to a full 12-month structure
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
    
            $quarterlyProfits[] = max($quarterRevenue - $quarterExpense, 0);
            $quarterlyLosses[] = max($quarterExpense - $quarterRevenue, 0);
        }
    
        return view('pages.dashboard.dashboard', compact(
            'activeProjectsCount',
            'newProjectsThisWeek',
            'lastWeekCount',
            'percentageChange',
            'totalExpenses',
            'totalBudget',
            'topContractors',
            'months',
            'expensesData',
            'revenuesData',
            'quarterlyProfits',
            'quarterlyLosses',
            'totalContractors',
           'availableContractors',
        'contractorPercentageChange',
        'totalStaff',
        'newStaffThisMonth',
         'staffPercentageChange',
         'currentMonthExpenses',
         'expensePercentageChange',
         'monthlyBudget',
            'budgetPercentage',
            'totalBudget',
        'budgetUtilization'
        ));
    }
}