<?php namespace MrJuliuss\Syntara\Models\Permissions;

use Illuminate\Database\Eloquent\Model;
use MrJuliuss\Syntara\Models\Permissions\PermissionExistsException;
use MrJuliuss\Syntara\Models\Permissions\NameRequiredException;
use MrJuliuss\Syntara\Models\Permissions\ValueRequiredException;

class Permission extends Model
{

    /**
     * Model 'Permission' table
     * @var string
     */
    protected $table = 'permissions';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('name','value', 'description');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

    /**
     * Return the identifiant of the permission
     * @return int id of the permission
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return the value of the permission
     * @return string value of the permission
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return description of the permission
     * @return string description of the permission
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Saves the permission.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = array())
    {
        $this->validate();

        return parent::save($options);
    }

    /**
     * Validate permissions
     * @return bool
     */
    public function validate()
    {
        if(!$name = $this->getName())
        {
            throw new NameRequiredException("A name is required for a permission, none given.");
        }

        if(!$value = $this->getValue())
        {
            throw new ValueRequiredException("A value is required for a permission, none given.");
        }

        // Check if the permission already exists
        $query = $this->newQuery();
        $persistedPermission = $query->where('value', '=', $value)->first();

        if($persistedPermission and $persistedPermission->getId() != $this->getId())
        {
            throw new PermissionExistsException("A permission already exists with value [$value], values must be unique for permissions.");
        }

        return true;
    }
}