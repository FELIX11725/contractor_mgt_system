<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'phase_status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->phase_status)) {
                $model->phase_status = 'pending';  // Default value if not set
            }
        });
    }
    /**
     * Get the status of the phase.
     */
    public function getStatusAttribute()
    {
        return ucfirst($this->attributes['phase_status']);  // Example: Capitalize the first letter of the status
    }

    /**
     * Set the status of the phase.
     */
    public function setStatusAttribute($value)
    {
        $this->attributes['phase_status'] = strtolower($value);  // Example: Store status in lowercase
    }

    /**
     * Get the project this phase belongs to.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function budgets()
{
    return $this->hasMany(Budget::class);
}
    /**
     * Get the milestones related to this phase.
     */
    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }
}
