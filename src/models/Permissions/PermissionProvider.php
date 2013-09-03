<?php namespace MrJuliuss\Syntara\Models;

use Illuminate\Support\Facades\Facade;
use \MrJuliuss\Syntara\Models\Permission;
use \MrJuliuss\Syntara\Permissions\PermissionNotFoundException;
use \MrJuliuss\Syntara\Permissions\PermissionExistsException;
use Validator;
use Config;

class PermissionProvider
{
    /**
     * Create permission
     * @param  array $attributes
     * @return Permission permission object
     */
    public function createPermission($attributes)
    {
        $validator = Validator::make($attributes, Config::get('syntara::rules.permissions.create'));

        if(!$validator->fails())
        {
            try
            {
                $permission = new Permission();
                $permission->fill($attributes);
                $permission->save();
            }
            catch(\PermissionExistsException $e)
            {

            }
            return $permission;
        }

        return null;
    }

    /**
     * Returns an all permissions.
     *
     * @return array
     */
    public function findAll()
    {
        $model = new Permission();

        return $model->newQuery()->get()->all();
    }

    /**
     * Find a permission by the given permission id
     * @param  int $id
     * @return Permission
     */
    public function findById($id)
    {
        $model = new Permission();

        if(!$permission = $model->newQuery()->find($id))
        {
            throw new PermissionNotFoundException("A permission could not be found with ID [$id].");
        }

        return $permission;
    }

    /**
     * Find a permission by the given permission value
     * @param  string $value
     * @return Permission
     */
    public function findByValue($value)
    {
        $model = new Permission();

        if(!$permission = $model->newQuery()->where('value', $value)->get()->first())
        {
            throw new PermissionNotFoundException("A permission could not be found with Value [$value].");
        }

        return $permission;
    }
}