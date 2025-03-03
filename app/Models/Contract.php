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
    protected $fillable = ['project_id', 'contractor_id', 'start_date', 'end_date', 'total_amount', 'contract_status', 'contract_type_id','description'];

    //one contract given to one contractor
    public function contractor()
    {
        return $this->belongsTo(Contractor::class, 'contractor_id');
    }
    //one contract for one project
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    
}
