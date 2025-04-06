<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class branch extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =['business_id','branch_name','branch_code','branch_phone','branch_email','branch_address','is_main'];
}
