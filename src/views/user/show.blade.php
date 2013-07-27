@extends('syntara::layouts.dashboard.master')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script> 
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/forms/check.js') }}"></script> 
{{ Breadcrumbs::create(array(array('title' => 'Users', 'link' => "dashboard/users", 'icon' => 'icon-user'), array('title' => $user->username, 'link' => URL::current(), 'icon' => ''))); }}

<div class="container-fluid" id="main-container">
    <div class="row-fluid">
        <div class="span6">
            <section class="module">
                <div class="module-head">
                    <b>{{ $user->getId() }} - {{ $user->username }}</b>
                </div>
                <div class="module-body">
                    <form class="form-horizontal" id="edit-user-form" method="PUT">
                         <div class="control-group">
                            <label class="control-label">Username :</label>
                            <div class="controls">
                                <input class="span12" type="text" id="username" name="username" value="{{ $user->username}}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Email :</label>
                            <div class="controls">
                                <input class="span12" type="text" id="email" name="email" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Password :</label>
                            <div class="controls">
                                <input class="span12" type="password" placeholder="Password" id="pass" name="pass" >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Last name :</label>
                            <div class="controls">
                                <input class="span12" type="text" id="last_name" name="last_name" value="{{ $user->last_name  }}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">First name :</label>
                            <div class="controls">
                                <input class="span12" type="text" id="first_name" name="first_name" value="{{ $user->first_name }}">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button id="update-user" class="btn btn-primary">Update</button>
                            </div>   
                        </div>
                    </form>
                </div>
            </section>
        </div>
        <div class="span6">
            <section class="module">
            <div class="module-head">
                <b>Informations</b>
            </div>
            <div class="module-body ajax-content">
                <div class="control-group">
                    <div class="controls">
                        <label>Registration : </label><p>{{ $user->created_at }}</p> 
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <label>Last update : </label><p>{{ $user->updated_at }}</p>
                    </div>   
                </div>
                <div class="control-group">
                    <div class="controls">
                        <label>Last login : </label><p>{{ $user->last_login }}</p>
                    </div>   
                </div>
                 <div class="control-group">
                    <div class="controls">
                        <label>Ip adress : </label><p>{{ $throttle->ip_address }}</p> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop