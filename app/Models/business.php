<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class business extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =['staff_id', 'business_name','business_email','business_phone','business_address','business_location','business_status','created_by'];

    //business can have many branches
    public function branches()
    {
        return $this->hasMany(branch::class, 'business_id');
    }

    //can have many staff
    public function staff()
    {
        return $this->hasMany(staff::class, 'staff_id');
    }
}
