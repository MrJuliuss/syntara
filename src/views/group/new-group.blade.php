@extends('syntara::layouts.dashboard.master')

@section('content')
<!--<link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/dashboard/users.css') }}" />-->
{{ Breadcrumbs::create(array(array('title' => 'Groups', 'link' => "dashboard/groups", 'icon' => 'icon-list-alt'), array('title' => 'New group', 'link' => URL::current(), 'icon' => 'icon-plus-sign'))); }}

<div class="container-fluid">
    <div class="row-fluid">
        <section class="module">
            <div class="module-head">
                <b>New group</b>
            </div>
            <div class="module-body">
                <form id="create-group-form" action="" method="POST">
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">Account informations</label>
                                <div class="controls">
                                    <p><input class="input-xxlarge" type="text" placeholder="User name" id="userName" name="userName"></p>
                                    <p><input class="input-xxlarge" type="text" placeholder="Email" id="userEmail" name="userEmail"></p>
                                    <p><input class="input-xxlarge" type="password" placeholder="Password" id="userPass" name="userPass"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button id="add-user" class="btn btn-primary">Create</button>
                </form>
            </div>
        </section>
    </div>
</div>
@stop