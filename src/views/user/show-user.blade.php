@extends('syntara::layouts.dashboard.master')

@section('content')

<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script>
<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-8">
            <section class="module">
                <div class="module-head">
                    <b>{{ $user->getId() }} - {{ $user->username }}</b>
                </div>
                <div class="module-body">
                    <form class="form-horizontal" id="edit-user-form" method="PUT">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Username</label>
                                <input class="col-lg-12 form-control" type="text" id="username" name="username" value="{{ $user->username}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input class="col-lg-12 form-control" type="text" id="email" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <input class="col-lg-12 form-control" type="password" placeholder="Password" id="pass" name="pass" >
                            </div>
                            <div class="form-group">
                                <label class="control-label">Last name</label>
                                <input class="col-lg-12 form-control" type="text" id="last_name" name="last_name" value="{{ $user->last_name  }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">First name</label>
                                <input class="col-lg-12 form-control" type="text" id="first_name" name="first_name" value="{{ $user->first_name }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Groups</label>
                            </div>
                            <div class="form-group">

                            @foreach($groups as $group)
                            <label class="checkbox-inline">
                                @if($currentUser->hasAccess('user-group-management'))
                                <input type="checkbox" id="groups[{{ $group->getId() }}]" name="groups[]" value="{{ $group->getId() }}" {{ ($user->inGroup($group)) ? 'checked="checked"' : ''}}>
                                @endif
                                {{ $group->getName() }}
                            </label>
                            @endforeach
                            </div>
                        </div>
                        <div class="col-lg-5">
                            @if($currentUser->hasAccess('permissions-management'))
                                @include('syntara::layouts.dashboard.permissions-select', array('permissions'=> $permissions))
                            @endif
                        </div>
                        <div class="col-lg-2">
                            <label>Banned</label>
                            <div class="switch-toggle well">
                                <input id="no" name="banned" type="radio" value="no" {{ ($throttle->isBanned() === false) ? 'checked' : '' }}>
                                <label for="no" onclick="">NO</label>

                                <input id="yes" name="banned" type="radio" value="yes" {{ ($throttle->isBanned() === true) ? 'checked' : '' }}>
                                <label for="yes" onclick="">YES</label>

                                <a class="btn btn-primary"></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <br>
                            <div class="form-group">
                                <button id="update-user" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </section>
        </div>
        <div class="col-lg-4">
            <section class="module">
            <div class="module-head">
                <b>Information</b>
            </div>
            <div class="module-body ajax-content">
                @include('syntara::user.user-informations')
            </div>
        </div>
    </div>
</div>
@stop