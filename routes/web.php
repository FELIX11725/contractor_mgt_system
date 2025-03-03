<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagePlans\ViewplansController;
use App\Http\Controllers\BudgetManagement\BudgetController;
use App\Http\Controllers\ManageExpenses\ExpensesController;
use App\Http\Controllers\ManagePlans\ProjectplansController;
use App\Http\Controllers\ManageContracts\ContractsController;
use App\Http\Controllers\ManageExpenses\ExpensetypeController;
use App\Http\Controllers\ManageMilestones\MilestoneController;
use App\Http\Controllers\ProjectManagement\ProjectsController;
use App\Http\Controllers\BudgetManagement\ViewbudgetController;
use App\Http\Controllers\ManageContracts\AddContractController;
use App\Http\Controllers\ProjectManagement\AddProjectController;
use App\Http\Controllers\ManageContractors\ContractorsController;
use App\Http\Controllers\ManageMilestones\AddMilestoneController;
use App\Http\Controllers\ManageContractors\AddContractorController;
use App\Http\Controllers\ManageContractors\ComplianceRecordsController;

Route::redirect('/', 'login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Route::view()
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // projects
    Route::prefix('projects-managment')->group(function () {
        Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
        Route::get('/addproject', [AddProjectController::class, 'index'])->name('addproject');
        Route::get('/projectplans',[ProjectplansController::class, 'index'])->name('projectplans');
        Route::get('/viewplans',[ViewplansController::class, 'index'])->name('viewplans');

    });
    //milestones
    Route::prefix('milestones')->group(function () {
        Route::get('/milestones', [MilestoneController::class, 'index'])->name('milestones');
        Route::get('/addmilestone', [AddMilestoneController::class, 'index'])->name('addmilestone');
    });
    //contractors
    Route::prefix('contractors')->group(function () {
        Route::get('/contractors', [ContractorsController::class, 'index'])->name('contractors');
        Route::get('/addcontractor',[AddContractorController::class, 'index'])->name('addcontractor');
        Route::get('/compliance-records', [ComplianceRecordsController::class, 'index'])->name('compliance-records');
    });
    //contracts
    Route::prefix('contracts')->group(function () {
        Route::get('/contracts', [ContractsController::class, 'index'])->name('contracts');
        Route::get('/addcontracts', [AddContractController::class, 'index'])->name('addcontracts');
    });
    //expenses
    Route::prefix('expenses')->group(function () {
        Route::get('/expensetypes',[ExpensetypeController::class, 'index'])->name('expensetypes');
        Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses');
    });
    //budgets
    Route::prefix('budgets')->group(function (){
        Route::get('/budgets', [BudgetController::class, 'index'])->name('budgets');
        Route::get('/viewbudgets',[ViewbudgetController::class, 'index'])->name('viewbudgets');
    });
});
