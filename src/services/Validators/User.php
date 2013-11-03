<?php namespace MrJuliuss\Syntara\Services\Validators;

class User extends \MrJuliuss\Syntara\Services\Validators\Validator
{
    public static $rules = array(
        'create' => array(
            'email' => array('required', 'email'),
            'pass' => array('required', 'min:6', 'max:18'),
            'username' => array('required', 'min:3', 'max:16', 'alpha'),
            'last_name' => array('min:3', 'max:16', 'alpha_dash'),
            'first_name' => array('min:3', 'max:16', 'alpha_dash'),
        ),
        'update' => array(
            'email' => array('required', 'email'),
            'pass' => array('min:6', 'max:18'),
            'username' => array('required', 'min:3', 'max:16', 'alpha'),
            'last_name' => array('min:3', 'max:16', 'alpha_dash'),
            'first_name' => array('min:3', 'max:16', 'alpha_dash'),  
        ),
        'login' => array(
            'email' => array('required', 'email'),
            'pass' => array('required', 'min:6', 'max:18'),
        ),
    );
}