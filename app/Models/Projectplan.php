<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectplan extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'plan_method'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function phases()
{
    return $this->hasMany(Phase::class,'project_plan_id');
}
public function milestones()
{
    return $this->hasMany(Projectmilestone::class,'project_plan_id');
}
public function budgets()
{
    return $this->belongsTo(Budget::class);
}
}
