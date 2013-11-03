<?php namespace MrJuliuss\Syntara\Services\Validators;

class Permission extends \MrJuliuss\Syntara\Services\Validators\Validator
{
    public static $rules = array(
        'name' => array('required', 'min:3', 'max:100'),
        'value' => array('required', 'alpha_dash', 'min:3', 'max:100'),
        'description' => array('required', 'min:3', 'max:255')
    );
}