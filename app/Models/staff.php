<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class staff extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['created_by', 'position', 'phone', 'business_id', 'branch_id','is_primary', 'first_name', 'last_name', 'email'];

    public function user(){
        return $this->hasOne(User::class, 'staff_id')->withTrashed();
    }
   
     public function documents()
     {
         return $this->hasMany(Document::class);
     }
        public function contractor()
        {
            return $this->hasOne(Contractor::class, 'staff_id');
        }
}
