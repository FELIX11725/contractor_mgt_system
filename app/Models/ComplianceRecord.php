<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplianceRecord extends Model
{
    use HasFactory;
    use SoftDeletes;
   
    protected $fillable =['contractor_id','document_name','document_path','doc_status','expiry_date','submitted_date'];

    //one contractor can have many compliance records
    public function contractor()
    {
        return $this->belongsTo(Contractor::class, 'contractor_id');
    }
}
