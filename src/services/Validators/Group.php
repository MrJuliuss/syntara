<?php namespace MrJuliuss\Syntara\Services\Validators;

class Group extends \MrJuliuss\Syntara\Services\Validators\Validator
{
    public static $rules = array(
        'groupname' => array('required', 'min:3', 'max:16', 'alpha'),
    );
}