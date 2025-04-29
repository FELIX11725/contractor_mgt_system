<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contractor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table= 'contractors';
    protected $fillable = ['first_name','last_name', 'contractor_email', 'contractor_phone', 'contractor_address', 'contractor_status','date_of_birth','gender',
    'nationality','marital_status','education_level','work_experience','staff_id','business_id','branch_id'];

    public function contracts(): HasOne
    {
        return $this->hasOne(Contract::class, 'contractor_id');
    }
    
}
