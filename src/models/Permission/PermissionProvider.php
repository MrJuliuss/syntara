<?php namespace MrJuliuss\Syntara\Models;

use Illuminate\Support\Facades\Facade;
use \MrJuliuss\Syntara\Models\Permission;

class PermissionProvider
{
    /**
     * Create permission
     * @param  array $attributes
     * @return Permission permission object
     */
    public function createPermission($attributes)
    {
        $permission = new Permission();
        $permission->fill($attributes);
        $permission->save();

        return $permission;
    }

    /**
     * Find a permission by the given permission id
     * @param  int $id
     * @return Permission
     */
    public function findPermissionById($id)
    {
        $model = new Permission();

        if(!$permission = $model->newQuery()->find($id))
        {
            // TODO throw exception
        }

        return $permission;
    }

    /**
     * Find a permission by the given permission value
     * @param  string $value
     * @return Permission
     */
    public function findPermissionByValue($value)
    {
        $model = new Permission();

        if(!$permission = $model->newQuery()->where('value', $value)->get()->first())
        {
            // TODO throw exception
        }

        return $permission;
    }
}