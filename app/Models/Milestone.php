<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Milestone extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'milestones';

    protected $fillable = [
        'project_id',
        'phase_id',
        'milestone_name',
        'due_date',
        'description',
        'milestone_status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->milestone_status)) {
                $model->milestone_status = 'pending';  // Default value if not set
            }
        });
    }

    /**
     * Get the project this milestone belongs to.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * Get the phase this milestone belongs to (optional).
     */
    public function phase(): BelongsTo
    {
        return $this->belongsTo(Phase::class, 'phase_id');
    }
}
