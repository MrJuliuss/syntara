<?php namespace MrJuliuss\Syntara\Services\Validators;
 
abstract class Validator {
 
    protected $attributes;
 
    protected $errors;
 
    public function __construct($data = null)
    {
        $this->attributes = $data ?: \Input::all();
    }
 
    public function passes()
    {
        $validation = \Validator::make($this->attributes, static::$rules);
 
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