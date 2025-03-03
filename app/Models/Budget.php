<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['project_plan_id','project_plan_item_name', 'expense_item', 'estimated_amount'];
    protected $table = 'budgets';
   
    public function projectPlans()
{
    return $this->belongsTo(ProjectPlan::class, 'project_plan_id');
}
//expense
public function expenses()
{
    return $this->hasOne(Expense::class);
}
public function project()
{
    return $this->belongsTo(Project::class,'project_plan_id');
}
}
