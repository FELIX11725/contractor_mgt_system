<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditlog extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'action', 'contractor_id', 'date'];
}
