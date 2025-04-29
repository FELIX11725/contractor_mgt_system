<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategoryItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['expense_category_id', 'name', 'description', 'user_id','has_quantity'];

    /**
     * Get the expense category that owns the item.
     */
    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }

    /**
     * Get the user that created the expense category item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
