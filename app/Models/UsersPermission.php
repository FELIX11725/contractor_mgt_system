<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'permission_id'
    ];
}
