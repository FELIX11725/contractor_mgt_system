<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;

    protected $fillable = ['project_plan_id', 'name','phase_status'];

    public function projectPlan()
{
    return $this->belongsTo(Projectplan::class, 'project_plan_id'); //  Specify the foreign key if it is not 'project_plan_id'
}
}
