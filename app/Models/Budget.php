<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['phase_id','budget_name', 'description', 'estimated_amount', 'milestone_id','approved'];
    protected $table = 'budgets';
   
    public function projectPlans()
{
    return $this->belongsTo(ProjectPlan::class, 'project_plan_id');
}
//expense
// Budget.php (Model)
public function phase()
{
    return $this->belongsTo(Phase::class);
}

public function milestone()
{
    return $this->belongsTo(Milestone::class);
}
public function project()
{
    return $this->belongsTo(Project::class,'project_plan_id');
}
}
