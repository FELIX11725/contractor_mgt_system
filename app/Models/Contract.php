<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'contracts';
    protected $fillable = ['project_id', 'contractor_id', 'start_date', 'end_date', 'total_amount', 'contract_status', 'contract_type_id','description','business_id', 'branch_id'];

    //one contract given to one contractor
    public function contractor()
    {
        return $this->belongsTo(staff::class, 'contractor_id');
    }
    //one contract for one project
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function contractType()
    {
        return $this->belongsTo(ContractType::class, 'contract_type_id');
    }

    //business and branches
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }


    
}
