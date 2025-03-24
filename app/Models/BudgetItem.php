<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['budget_id', 'expense_category_item_id', 'estimated_amount', 'quantity', 'rate'];

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function expenseCategoryItem()
    {
        return $this->belongsTo(ExpenseCategoryItem::class);
    }

    // expenses
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'budget_items_id');
    }

    // Approved Expenses
    public function approvedExpenses()
    {
        return $this->hasMany(Expense::class, 'budget_items_id')->whereHas('approvals', function ($query) {
            $query->where('is_approved', true);
        });
    }
}
