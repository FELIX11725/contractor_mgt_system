<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Livewire\Budget\BudgetDetailsComponent;
use App\Livewire\Expenses\ExpenseCategoriesComponent;
use App\Livewire\Business\AddNewBusinessFormComponent;
use App\Livewire\Preojects\ViewProjectDetailsComponent;
use App\Http\Controllers\ManageLogs\AuditLogsController;
use App\Http\Controllers\ManagePlans\ViewplansController;
use App\Livewire\Expenses\ExpenseCategoryDetailsComponent;
use App\Http\Controllers\BudgetManagement\BudgetController;
use App\Http\Controllers\ManageExpenses\ExpensesController;
use App\Http\Controllers\ManageExpenses\ReceiptsController;
use App\Http\Controllers\ManageStaff\RoleManagerController;
use App\Http\Controllers\ManagePlans\ProjectplansController;
use App\Http\Controllers\ManageContracts\ContractsController;
use App\Http\Controllers\ManageExpenses\AddExpenseController;
use App\Http\Controllers\ManageExpenses\ExpensetypeController;

use App\Http\Controllers\ManageExpenses\ViewExpenseController;

use App\Http\Controllers\ManageMilestones\MilestoneController;
use App\Http\Controllers\ProjectManagement\ProjectsController;
use App\Http\Controllers\BudgetManagement\ViewbudgetController;
use App\Http\Controllers\ManageContracts\AddContractController;
use App\Http\Controllers\ProjectManagement\AddProjectController;
use App\Http\Controllers\ManageContractors\ContractorsController;
use App\Http\Controllers\ManageExpenses\ApproveExpenseController;
use App\Http\Controllers\ManageMilestones\AddMilestoneController;
use App\Http\Controllers\ManageContractors\AddContractorController;
use App\Http\Controllers\ManageContractors\ComplianceRecordsController;

Route::redirect('/', 'login');
Route::redirect('/register', 'login');


Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Route::view()
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // projects
    Route::prefix('projects-managment')->group(function () {
        Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
        Route::get('/projects/{project}', ViewProjectDetailsComponent::class)->name('projects.show');
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
        Route::get('/{staff}/profile', [ContractorsController::class, 'showProfile'])->name('contractors.profile');
         Route::put('/{staff}/update', [ContractorsController::class, 'updateProfile'])->name('contractors.update-profile');
    Route::post('/{staff}/documents', [ContractorsController::class, 'uploadDocument'])->name('contractors.upload-document');
    Route::get('/documents/{document}/download', [ContractorsController::class, 'downloadDocument'])->name('contractors.download-document');
    Route::delete('/documents/{document}', [ContractorsController::class, 'deleteDocument'])->name('contractors.delete-document');
       
        Route::get('/role-manager', [RoleManagerController::class, 'index'])->name('role-manager');
    });
    //contracts
    Route::prefix('contracts')->group(function () {
        Route::get('/contracts', [ContractsController::class, 'index'])->name('contracts');
        Route::get('/addcontracts', [AddContractController::class, 'index'])->name('addcontracts');
    });
    //expenses
    Route::prefix('expenses')->group(function () {
        Route::get('/expenseitems', [ExpensetypeController::class, 'index'])->name('expenseitems');
        Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses');
        Route::get('/expense-categories', ExpenseCategoriesComponent::class)->name('expenses.manage-categories');
        Route::get('/expense-categories/{category}', ExpenseCategoryDetailsComponent::class)->name('expenses.categories.view');
        Route::get('/expensetypes/{categoryId}', [ExpenseTypeController::class, 'show'])->name('expensetypes');
        Route::get('/add-expense', [AddExpenseController::class, 'index'])->name('add-expense');
        Route::get('/view-expense', [ViewExpenseController::class, 'index'])->name('view-expense');
        Route::get('/approve-expense', [ApproveExpenseController::class, 'index'])->name('approve-expense');
        
    });
    //budgets
    Route::prefix('budgets')->group(function (){
        Route::get('/budgets', [BudgetController::class, 'index'])->name('budgets');
        Route::get('/viewbudgets',[ViewbudgetController::class, 'index'])->name('viewbudgets');
        Route::get('/budgets/{budget}/details', BudgetDetailsComponent::class )->name('budgets.details');
    });
    Route::get('/receipts', [ReceiptsController::class, 'index'])->name('receipts');

    Route::get('/business/create', AddNewBusinessFormComponent::class)->name('business.new');
    //auditlogs
    Route::get('/auditlogs', [AuditLogsController::class, 'index'])->name('auditlogs');
});
