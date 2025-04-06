<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersRoles extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id'
    ];

    public function roles(){
        return $this->belongsTo(Role::class, 'role_id');
    }
}
