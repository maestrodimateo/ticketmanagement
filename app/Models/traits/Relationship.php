<?php
namespace App\Models\traits;

use App\Models\Model;

trait Relationship
{
    /**
     * Get the parent model
     *
     * @param string $model
     * @param string $foreignKey
     * @param string $id if the id is named differently
     * @return App\Models\Model|null
     */
    public function belongsTo(string $model, string $foreignKey, $id = 'id')
    {
        $parent_model = new $model;
        if (!$parent_model instanceof Model) {
            throw new \Exception("The class $model is not an instance of " . Model::class, 1);
        }

        $array_data = $parent_model->select()->where($id, $this->$foreignKey)->limit(1)->get();
        return array_shift($array_data);
    }

    /**
     * Get all the models
     *
     * @param string $model
     * @param string $foreignKey
     * @return array
     */
    public function hasMany(string $model, string $foreignKey): array
    {
        $child_model = new $model;
        if (!$child_model instanceof Model) {
            throw new \Exception("The class $model is not an instance of " . Model::class, 1);
        }

        return $child_model->select()->where($foreignKey, $this->id)->get();
    }

}