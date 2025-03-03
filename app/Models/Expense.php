<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['amount_paid','payment_method','payment_date','expense_status', 'project_plan_id', 'project_id','budget_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
    public function projectPlan()
    {
        return $this->belongsTo(ProjectPlan::class);
    }
}
