@extends('syntara::layouts.dashboard.master')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script>

<div class="container" id="main-container">
    @include('syntara::layouts.dashboard.confirmation-modal',  array('title' => "Confirm delete", 'content' => 'Are you sure you want to delete these items ?', 'type' => 'delete-user'))
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
                            <label for="userIdSearch">User ID</label>
                            <input type="text" class="form-control" id="userIdSearch" name="userIdSearch">
                        </div>
                        <div class="form-group">
                            <label for="usernameSearch">Username</label>
                            <input type="text" class="form-control" id="usernameSearch" name="usernameSearch">
                        </div>
                        <div class="form-group">
                            <label for="emailSearch">Email</label>
                            <input type="email" class="form-control" id="emailSearch" name="emailSearch">
                        </div>
                        <div class="form-group">
                            <label for="bannedSearch">Banned</label>
                            <select class="form-control" id="bannedSearch" name="bannedSearch">
                                <option></option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@stop