<?php

$rules = array(
    'email' => array('required', 'email'),
    'pass' => array('required', 'min:6', 'max:18'),
    'username' => array('required', 'min:3', 'max:16', 'alpha'),
    'last_name' => array('min:3', 'max:16', 'alpha'),
    'first_name' => array('min:3', 'max:16', 'alpha')

);

return array(
    'rules' => array(
        'users' => array(
            'login' => array(
                'email' => $rules['email'],
                'pass' => $rules['pass'],
            ),
            'create' => array(
                'email' => $rules['email'],
                'pass' => $rules['pass'],
                'username' => $rules['username'],
                'last_name' => $rules['last_name'],
                'first_name' => $rules['first_name']
            ),
        ),
    ),
);