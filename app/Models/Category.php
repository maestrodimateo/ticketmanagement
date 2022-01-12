<?php
namespace App\Models;

use App\Models\Model;

class Category extends Model
{
    protected $table = 'categories';

    /**
     * A category can have bugs
     */
    public function bugs()
    {
        return $this->hasMany(Bug::class, 'category_id');
    }
}