<?php namespace MrJuliuss\Syntara\Services\Validators\User;

class CreateUserValidator extends \MrJuliuss\Syntara\Services\Validators\Validator
{
    public static $rules = [
        'email' => array('required', 'email'),
        'pass' => array('required', 'min:6', 'max:18'),
        'username' => array('required', 'min:3', 'max:16', 'alpha'),
        'last_name' => array('min:3', 'max:16', 'alpha_dash'),
        'first_name' => array('min:3', 'max:16', 'alpha_dash'),
    ];
}