<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class document extends Model
{
    use HasFactory;

      protected $fillable = [
        'staff_id',
        'name',
        'file_path',
        'original_name',
        'issue_date',
        'expiry_date',
        'uploaded_by'
    ];
    protected $dates = [
        'issue_date',
        'expiry_date',
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
