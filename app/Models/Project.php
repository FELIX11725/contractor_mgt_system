<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'projects';
    

    
   protected $fillable = ['project_name', 'location', 'project_type_id', 'project_description', 'start_date', 'end_date', 'project_status'];
    
  //has many project types
   public function project_type()
   {
       return $this->belongsTo(ProjectType::class, 'project_type_id');
   }

   public function milestones()
   {
       return $this->hasManyThrough(Projectmilestone::class, ProjectPlan::class, 'project_id', 'project_plan_id');
   }
   
   public function phases()
   {
       return $this->hasManyThrough(Phase::class, ProjectPlan::class, 'project_id', 'project_plan_id');
   }

   public function contracts(): HasMany
   {
       return $this->hasMany(Contract::class, 'project_id');
   }
   
 


    //project has one projectplan
    public function projectplan()
    {
        return $this->hasOne(ProjectPlan::class);
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class,'project_plan_id');
    }

    // Relationship to Expenses
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
    
   
   
   
    
}
