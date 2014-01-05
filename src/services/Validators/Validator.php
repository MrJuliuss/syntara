<?php namespace MrJuliuss\Syntara\Services\Validators;

abstract class Validator {

    protected $attributes;

    protected $errors;

    protected $level;

    public static $rules = array();

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
        
        $messages = array();
        if(is_array(trans('syntara::validation')))
        {
            $messages = trans('syntara::validation');
        }

        $validation = \Validator::make($this->attributes, $rules, $messages);

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


