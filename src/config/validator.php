<?php

return array(
    'user' => array(
        'create' => array(
                'email' => array('required', 'email'),
                'pass' => array('required', 'min:6', 'max:255'),
                'username' => array('required', 'min:3', 'max:255', 'alpha'),
                'last_name' => array('min:3', 'max:255', 'alpha_dash'),
                'first_name' => array('min:3', 'max:255', 'alpha_dash'),
            ),
        'update' => array(
            'email' => array('required', 'email'),
            'pass' => array('min:6', 'max:255'),
            'username' => array('required', 'min:3', 'max:255', 'alpha'),
            'last_name' => array('min:3', 'max:255', 'alpha_dash'),
            'first_name' => array('min:3', 'max:255', 'alpha_dash'),
            ),
        'login' => array(
                'email' => array('required', 'email'),
                'pass' => array('required', 'min:6', 'max:255'),
            ),
    ),
    'group' => array(
        'groupname' => array('required', 'min:3', 'max:16', 'alpha'),
    ),
    'permission' => array(
        'name' => array('required', 'min:3', 'max:100'),
        'value' => array('required', 'alpha_dash', 'min:3', 'max:100'),
        'description' => array('required', 'min:3', 'max:255')
    ),
);