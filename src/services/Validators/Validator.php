<?php namespace MrJuliuss\Syntara\Services\Validators;
 
abstract class Validator {
 
    protected $attributes;
 
    protected $errors;

    protected $level;

    public static $rules = [];
 
    public function __construct($data = null, $level = null)
    {
        $this->attributes = $data ?: \Input::all();
        $this->level = $level;
    }
 
    public function passes()
    {
        $rules = array();
        if($this->level !== null)
        {
            $rules = static::$rules[$this->level];
        }
        else
        {
            $rules = static::$rules;

        }
        
        $validation = \Validator::make($this->attributes, $rules);

        if($validation->passes())
        {
            return true;
        }

        $this->errors = $validation->messages()->getMessages();

        return false;
    }

    public function getErrors()
    {
        return $this->errors;
    }

}