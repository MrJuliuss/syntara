@extends('syntara::layouts.dashboard.master')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/permission.js') }}"></script>
@include('syntara::layouts.dashboard.confirmation-modal',  array('title' => "Confirm delete", 'content' => 'Are you sure you want to delete these items ?', 'type' => 'delete-permission'))
<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-10">
            <section class="module">
                <div class="module-head">
                    <b>All permissions</b>
                </div>
                <div class="module-body ajax-content">
                    @include('syntara::permission.list-permissions')
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
                            <label for="permissionIdSearch">Permission ID</label>
                            <input type="text" class="form-control" id="permissionIdSearch" name="permissionIdSearch">
                        </div>
                        <div class="form-group">
                            <label for="permissionNameSearch">Name</label>
                            <input type="text" class="form-control" id="permissionNameSearch" name="permissionNameSearch">
                        </div>
                        <div class="form-group">
                            <label for="permissionValueSearch">Value</label>
                            <input type="text" class="form-control" id="permissionValueSearch" name="permissionValueSearch">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@stop