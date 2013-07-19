@extends('syntara::layouts.dashboard.master')

@section('content')
<link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/dashboard/users.css') }}" />
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script> 
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/forms/check.js') }}"></script> 
{{ Breadcrumbs::create(array(array('title' => 'Users', 'link' => "dashboard/users", 'icon' => 'icon-user'), array('title' => 'New user', 'link' => "dashboard/user/new", 'icon' => 'icon-plus-sign'))); }}

<section class="module">
    <div class="module-head">
        <b>New user</b>
    </div>
    <div class="module-body">
        <form id="create-user-form" action="" method="POST">
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
				<div class="span4">
					<div class="control-group">
						<label class="control-label">Profile informations</label>
						<div class="controls">
							<p><input class="input-xxlarge" type="text" placeholder="Last name" id="userLastName" name="userLastName"></p>
							<p><input class="input-xxlarge" type="text" placeholder="First name" id="userFirstName" name="userFirstName"></p>
						</div>
					</div>
				</div>
			</div>
            <br>
            <button id="add-user" class="btn btn-primary">Create</button>
        </form>
    </div>
</section>
@stop