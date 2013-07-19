@extends('syntara::layouts.dashboard.master')

@section('content')
<link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/dashboard/users.css') }}" />
{{ Breadcrumbs::create(array(array('title' => 'Users', 'link' => "dashboard/users", 'icon' => 'icon-user'))); }}

<section class="module">
    <div class="module-head">
        <b>{{ $user->getId() }} - {{ $user->username }}</b>
    </div>
    <div class="module-body ajax-content">
        <div class="row-fluid">
            <div class="span6">
                <form class="form-horizontal">
                     <div class="control-group">
                        <label class="control-label">Username :</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" id="userName" name="userName" value="{{ $user->username}}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Email :</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" id="userEmail" name="userEmail" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Password :</label>
                        <div class="controls">
                            <input class="input-xlarge" type="password" placeholder="Password" id="userPass" name="userPass" >
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Password again :</label>
                        <div class="controls">
                            <input class="input-xlarge" type="password"  id="userPassAgain" name="userPassAgain" >
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Last name :</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" id="userLastName" name="userLastName" value="{{ $user->last_name  }}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">First name :</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" id="userFirstName" name="userFirstName" value="{{ $user->first_name }}">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button id="update-user" class="btn btn-primary">Update</button>
                        </div>   
                    </div>
                </form>
            </div>
            <div>
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
            </div>
        </div>
    </div>
</section>
@stop