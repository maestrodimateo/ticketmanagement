<?php
namespace App\Models;

use App\Models\Model;

class Service extends Model
{
    protected $table = 'services';
    
    /**
     * A service belongs to a department
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}