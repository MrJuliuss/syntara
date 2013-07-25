<?php

return array(
    'rules' => array(
        'users' => array(
            'login' => array(
                'login' => array('required', 'email'),
                'pass' => array('required', 'min:6', 'max:18'),
            ),
        ),
    ),
);