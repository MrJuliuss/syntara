<?php 

return array(
    'dashboard' => array(
        array(
            'title' => 'My Dashboard',
            'link' => 'dashboard',
            'icon' => 'glyphicon-home'
        )
    ),
    'login' => array(
        array(
            'title' => 'Login',
            'link' => "dashboard/login",
            'icon' => 'glyphicon-user'
        )
    ),
    'users' => array(
        array(
            'title' => 'Users',
            'link' => "dashboard/users",
            'icon' => 'glyphicon-user'
        )
    ),
    'create_user' => array(
        array(
            'title' => 'Users',
            'link' => "dashboard/users",
            'icon' => 'glyphicon-user'
        ), 
        array(
            'title' => 'New user',
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'groups' => array(
        array(
            'title' => 'Groups',
            'link' => "dashboard/groups",
            'icon' => 'glyphicon-list-alt'
        )
    ),
    'create_group' => array(
        array(
            'title' => 'Groups',
            'link' => "dashboard/groups",
            'icon' => 'glyphicon-list-alt'
        ),
        array(
            'title' => 'New group',
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'permissions' => array(
       array(
            'title' => 'Permissions',
            'link' => "dashboard/permissions",
            'icon' => 'glyphicon-ban-circle'
        )
    ),
    'create_permission' => array(
        array(
            'title' => 'Permissions',
            'link' => "dashboard/permissions",
            'icon' => 'glyphicon-ban-circle'
        ),
        array(
            'title' => 'New permission',
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
);