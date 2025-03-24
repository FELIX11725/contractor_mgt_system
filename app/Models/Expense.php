<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'expenses';

    protected $fillable = [
        'budget_items_id',
        'amount_paid',
        'date_of_pay',
        'description',
    ];
    public function budgetItem()
    {
        return $this->belongsTo(BudgetItem::class, 'budget_items_id');
    }
    public function category()
    {
        return $this->hasOneThrough(
            ExpenseCategoryItem::class,
            BudgetItem::class,
            'id', // Foreign key on BudgetItem table
            'id', // Foreign key on ExpenseCategoryItem table
            'budget_items_id', // Local key on Expense table
            'expense_category_item_id' // Local key on BudgetItem table
        );
    }
    public function approvals()
    {
        return $this->hasMany(ExpenseApproval::class);
    }
    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
}
