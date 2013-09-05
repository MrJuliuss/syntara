@extends('syntara::layouts.dashboard.master')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script>
<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-12">
            <section class="module">
                <div class="module-head">
                    <b>New user</b>
                </div>
                <div class="module-body">
                    <form class="form-horizontal" id="create-user-form" method="POST">
                        <div class="row">
                            <div class="col-lg-6">
                                 <div class="form-group">
                                    <label class="control-label">Username</label>
                                    <p><input class="col-lg-12 form-control" type="text" placeholder="User name" id="username" name="username"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <p><input class="col-lg-12 form-control" type="text" placeholder="Email" id="email" name="email"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <p><input class="col-lg-12 form-control" type="password" placeholder="Password" id="pass" name="pass"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Last name</label>
                                    <p><input class="col-lg-12 form-control" type="text" placeholder="Last name" id="last_name" name="last_name"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">First name </label>
                                    <p><input class="col-lg-12 form-control" type="text" placeholder="First name" id="first_name" name="first_name"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                            @if($currentUser->hasAccess('user-group-management'))
                                <label class="control-label">Groups</label>
                                <div class="form-group">
                                @foreach($groups as $group)
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="groups[{{ $group->getId() }}]" name="groups[]" value="{{ $group->getId() }}">{{ $group->getName() }}
                                </label>
                                @endforeach
                                </div>
                            @endif
                                <div class="form-group">
                                    @include('syntara::layouts.dashboard.permissions-select', array('permissions'=> $permissions))
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button id="add-user" class="btn btn-primary" style="margin-top: 15px;">Create</button>
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