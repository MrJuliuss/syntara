<?php namespace MrJuliuss\Syntara\Models;

use Eloquent;

class Permission extends Eloquent
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
     * Set permission name
     * @param string $name Name of permission
     */
    public function setName($name)
    {
        $this->attributes['name'] = ucfirst($name);
    }

    /**
     * Set permission value
     * @param string $value
     */
    public function setValue($value)
    {
        $this->attributes['value'] = $value;
    }

    /**
     * Set permission description
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }

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
}