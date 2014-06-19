<?php 

return array(
    // layouts
    'master' => 'syntara::layouts.dashboard.master',
    'header' => 'syntara::layouts.dashboard.header',
    'permissions-select' => 'syntara::layouts.dashboard.permissions-select',

    // dashboard
    'dashboard-index' => 'syntara::dashboard.index',
    'login' => 'syntara::dashboard.login',
    'error' => 'syntara::dashboard.error',

    // users
    'users-index' => 'syntara::user.index-user',
    'users-list' => 'syntara::user.list-users',
    'user-create' => 'syntara::user.new-user',
    'user-informations' => 'syntara::user.user-informations',
    'user-profile' => 'syntara::user.show-user',
    'user-activation' => 'syntara::user.activation',

    // groups
    'groups-index' => 'syntara::group.index-group',
    'groups-list' => 'syntara::group.list-groups',
    'group-create' => 'syntara::group.new-group',
    'users-in-group' => 'syntara::group.list-users-group',
    'group-edit' => 'syntara::group.show-group',

    // permissions
    'permissions-index' => 'syntara::permission.index-permission',
    'permissions-list' => 'syntara::permission.list-permissions',
    'permission-create' => 'syntara::permission.new-permission',
    'permission-edit' => 'syntara::permission.show-permission',
);