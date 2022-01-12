<?php
namespace App\Models;

use App\Models\Model;

class Department extends Model
{
    protected $table = 'departments';

    /**
     * A department has many services
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'department_id');
    }
}