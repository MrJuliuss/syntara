@extends('syntara::layouts.dashboard.master')

@section('content')
<link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/dashboard/users.css') }}" />
{{ Breadcrumbs::create(array(array('title' => 'Users', 'link' => "dashboard/users", 'icon' => 'icon-user'), array('title' => 'New user', 'link' => "dashboard/user/new", 'icon' => 'icon-plus-sign'))); }}

<section class="module" style="margin: 20px;">
    <div class="module-head">
        <b>New user</b>
    </div>
    <div class="module-body">
        <form action="" method="POST">
            <div class="span4">
                <div class="control-group">
                    <label class="control-label">Account informations</label>
                    <div class="controls">
                        <p><input class="input-xlarge" type="text" placeholder="Email"></p>
                        <p><input class="input-xlarge" type="text" placeholder="Password"></p>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Profile informations</label>
                <div class="controls">
                    <p><input class="input-xlarge" type="text" placeholder="Last name"></p>
                    <p><input class="input-xlarge" type="text" placeholder="First name"></p>
                </div>
            </div>
            <br>
            <button class="btn btn-primary">Create</button>
        </form>
    </div>
</section>
@stop