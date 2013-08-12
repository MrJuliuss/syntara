@extends('syntara::layouts.dashboard.master')

@section('title', 'User '.$user->username)

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script> 
{{ Breadcrumbs::create(array(array('title' => 'Users', 'link' => "dashboard/users", 'icon' => 'glyphicon-user'), array('title' => $user->username, 'link' => URL::current(), 'icon' => ''))); }}

<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-6">
            <section class="module">
                <div class="module-head">
                    <b>{{ $user->getId() }} - {{ $user->username }}</b>
                </div>
                <div class="module-body">
                    <form class="form-horizontal" id="edit-user-form" method="PUT">
                         <div class="form-group">
                            <label class="control-label">Username :</label>
                            <input class="col-lg-12 form-control" type="text" id="username" name="username" value="{{ $user->username}}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email :</label>
                            <input class="col-lg-12 form-control" type="text" id="email" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password :</label>
                            <input class="col-lg-12 form-control" type="password" placeholder="Password" id="pass" name="pass" >
                        </div>
                        <div class="form-group">
                            <label class="control-label">Last name :</label>
                            <input class="col-lg-12 form-control" type="text" id="last_name" name="last_name" value="{{ $user->last_name  }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">First name :</label>
                            <input class="col-lg-12 form-control" type="text" id="first_name" name="first_name" value="{{ $user->first_name }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Groups :</label>
                        </div>
                        <div class="form-group">
                         
                        @foreach($groups as $group)
                        <label class="checkbox-inline">
                            <input type="checkbox" id="groups[{{ $group->getId() }}]" name="groups[]" value="{{ $group->getId() }}" {{ ($user->inGroup($group)) ? 'checked="checked"' : ''}}>{{ $group->getName() }} 
                        </label>
                        @endforeach
                        </div>
                        <br>
                        <div class="form-group">
                            <button id="update-user" class="btn btn-primary">Update</button>
                        </div>
                        
                    </form>
                </div>
            </section>
        </div>
        <div class="col-lg-6">
            <section class="module">
            <div class="module-head">
                <b>Informations</b>
            </div>
            <div class="module-body ajax-content">
                <label>Registration : </label><p>{{ $user->created_at }}</p> 
                <label>Last update : </label><p>{{ $user->updated_at }}</p>
                <label>Last login : </label><p>{{ $user->last_login }}</p>
                <label>Ip adress : </label><p>{{ $throttle->ip_address }}</p> 
            </div>
        </div>
    </div>
</div>
@stop