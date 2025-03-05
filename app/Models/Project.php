<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'projects';

    protected $fillable = [
        'project_name',
        'location',
        'project_type_id',
        'project_description',
        'start_date',
        'end_date',
        'project_status'
    ];

    /**
     * Project belongs to a Project Type.
     */
    public function project_type(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class, 'project_type_id');
    }

    /**
     * Project has many phases.
     */
    public function phases(): HasMany
    {
        return $this->hasMany(Phase::class);
    }

    /**
     * Project has many milestones.
     */
    public function milestones(): HasMany
    {
        return $this->hasMany(Milestone::class);
    }

    /**
     * Project has many contracts.
     */
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'project_id');
    }

    /**
     * Project has one project plan.
     */
    public function projectPlan(): HasOne
    {
        return $this->hasOne(ProjectPlan::class, 'project_id');
    }

    /**
     * Project has many budgets.
     */
    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'project_id');
    }

    /**
     * Project has many expenses.
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
