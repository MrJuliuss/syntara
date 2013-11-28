<?php 

return array(
    'dashboard' => array(
        array(
            'title' => trans('syntara::breadcrumbs.dashboard'),
            'link' => URL::current(),
            'icon' => 'glyphicon-home'
        )
    ),
    'login' => array(
        array(
            'title' => trans('syntara::breadcrumbs.login'),
            'link' => URL::route('getLogin'),
            'icon' => 'glyphicon-user'
        )
    ),
    'users' => array(
        array(
            'title' => trans('syntara::breadcrumbs.users'),
            'link' => URL::route('listUsers'),
            'icon' => 'glyphicon-user'
        )
    ),
    'create_user' => array(
        array(
            'title' => trans('syntara::breadcrumbs.users'),
            'link' => URL::route('listUsers'),
            'icon' => 'glyphicon-user'
        ), 
        array(
            'title' => trans('syntara::breadcrumbs.new-user'),
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'groups' => array(
        array(
            'title' => trans('syntara::breadcrumbs.groups'),
            'link' => URL::route('listGroups'),
            'icon' => 'glyphicon-list-alt'
        )
    ),
    'create_group' => array(
        array(
            'title' => trans('syntara::breadcrumbs.groups'),
            'link' => URL::route('listGroups'),
            'icon' => 'glyphicon-list-alt'
        ),
        array(
            'title' => trans('syntara::breadcrumbs.new-group'),
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'permissions' => array(
       array(
            'title' => trans('syntara::breadcrumbs.permissions'),
            'link' => URL::route('listPermissions'),
            'icon' => 'glyphicon-ban-circle'
        )
    ),
    'create_permission' => array(
        array(
            'title' => trans('syntara::breadcrumbs.permissions'),
            'link' => URL::route('listPermissions'),
            'icon' => 'glyphicon-ban-circle'
        ),
        array(
            'title' => trans('syntara::breadcrumbs.new-permission'),
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
);