<?php namespace MrJuliuss\Syntara\Services\Validators;

use Config;

class Group extends \MrJuliuss\Syntara\Services\Validators\Validator
{
    public function __construct($data = null, $level = null)
    {
        parent::__construct($data, $level);

        static::$rules = Config::get('syntara::validator.group');
    }
}