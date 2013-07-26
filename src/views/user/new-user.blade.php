@extends('syntara::layouts.dashboard.master')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script> 
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/forms/check.js') }}"></script> 
{{ Breadcrumbs::create(array(array('title' => 'Users', 'link' => "dashboard/users", 'icon' => 'icon-user'), array('title' => 'New user', 'link' => URL::current(), 'icon' => 'icon-plus-sign'))); }}

<div class="container-fluid" id="main-container">
    <div class="row-fluid">
        <div class="span12">
            <section class="module">
                <div class="module-head">
                    <b>New user</b>
                </div>
                <div class="module-body">
                    <form class="form-horizontal" id="create-user-form" method="POST">
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">User name :</label>
                                    <div class="controls">
                                        <p><input class="span12" type="text" placeholder="User name" id="username" name="username"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Email :</label>
                                    <div class="controls">
                                        <p><input class="span12" type="text" placeholder="Email" id="email" name="email"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Password :</label>
                                    <div class="controls">
                                        <p><input class="span12" type="password" placeholder="Password" id="pass" name="pass"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">Last name :</label>
                                    <div class="controls">
                                        <p><input class="span12" type="text" placeholder="Last name" id="last_name" name="last_name"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">First name : </label>
                                    <div class="controls">
                                        <p><input class="span12" type="text" placeholder="First name" id="first_name" name="first_name"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="span12">
                                <div class="control-group">
                                    <div class="controls">
                                        <button id="add-user" class="btn btn-primary">Create</button>
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@stop