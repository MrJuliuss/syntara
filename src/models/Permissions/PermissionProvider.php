<?php namespace MrJuliuss\Syntara\Models\Permissions;

use Illuminate\Support\Facades\Facade;
use MrJuliuss\Syntara\Models\Permissions\PermissionNotFoundException;
use MrJuliuss\Syntara\Models\Permissions\PermissionExistsException;

class PermissionProvider
{
    protected $_model = 'MrJuliuss\Syntara\Models\Permissions\Permission';

    /**
     * Create permission
     * @param  array $attributes
     * @return Permission permission object
     */
    public function createPermission($attributes)
    {
        $permission = $this->createModel();
        $permission->fill($attributes);
        $permission->save();

        return $permission;
    }

    /**
     * Create a new instance of the model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createModel()
    {
        $class = '\\'.ltrim($this->_model, '\\');

        return new $class;
    }

    /**
     * Returns an all permissions.
     *
     * @return array
     */
    public function findAll()
    {
        return $this->createModel()->newQuery()->get()->all();
    }

    /**
     * Find a permission by the given permission id
     * @param  int $id
     * @return Permission
     */
    public function findById($id)
    {
        if(!$permission = $this->createModel()->newQuery()->find($id))
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
        if(!$permission = $this->createModel()->newQuery()->where('value', '=', $value)->get()->first())
        {
            throw new PermissionNotFoundException("A permission could not be found with Value [$value].");
        }

        return $permission;
    }
}