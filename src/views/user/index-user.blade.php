@extends('syntara::layouts.dashboard.master')

@section('title', 'Users list')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script> 
{{ Breadcrumbs::create(array(array('title' => 'Users', 'link' => "dashboard/users", 'icon' => 'glyphicon-user'))); }}
<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-10">
            <section class="module">
                <div class="module-head">
                    <b>All users</b>
                </div>
                <div class="module-body ajax-content">
                    @include('syntara::user.list-users')
                </div>
            </section>
        </div>
        <div class="col-lg-2">
            <section class="module">
                <div class="module-head">
                    <b>Search</b>
                </div>
                <div class="module-body">
                    <form id="search-form" onsubmit="return false;">
                        <div class="form-group">
                            <label for="userIdSearch">User id :</label>
                            <input type="text" class="form-control" id="userIdSearch" name="userIdSearch">
                        </div>
                        <div class="form-group">
                            <label for="usernameSearch">User name :</label>
                            <input type="text" class="form-control" id="usernameSearch" name="usernameSearch">
                        </div>
                        <div class="form-group">
                            <label for="emailSearch">Email :</label>
                            <input type="email" class="form-control" id="emailSearch" name="emailSearch">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@stop