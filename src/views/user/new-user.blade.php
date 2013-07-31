@extends('syntara::layouts.dashboard.master')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script> 
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/forms/check.js') }}"></script> 
{{ Breadcrumbs::create(array(array('title' => 'Users', 'link' => "dashboard/users", 'icon' => 'icon-user'), array('title' => 'New user', 'link' => URL::current(), 'icon' => 'icon-plus-sign'))); }}

<div class="container" id="main-container">
    <div class="row">
        <section class="module">
            <div class="module-head">
                <b>New user</b>
            </div>
            <div class="module-body">
                <form class="form-horizontal" id="create-user-form" method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                             <div class="form-group">
                                <label class="control-label">User name :</label>
                                <p><input class="col-lg-12 form-control" type="text" placeholder="User name" id="username" name="username"></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email :</label>
                                <p><input class="col-lg-12 form-control" type="text" placeholder="Email" id="email" name="email"></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password :</label>
                                <p><input class="col-lg-12 form-control" type="password" placeholder="Password" id="pass" name="pass"></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Last name :</label>
                                <p><input class="col-lg-12 form-control" type="text" placeholder="Last name" id="last_name" name="last_name"></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">First name : </label>
                                <p><input class="col-lg-12 form-control" type="text" placeholder="First name" id="first_name" name="first_name"></p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <button id="add-user" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@stop