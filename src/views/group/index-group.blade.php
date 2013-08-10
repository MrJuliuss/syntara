@extends('syntara::layouts.dashboard.master')

@section('title', 'Groups list')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/group.js') }}"></script>
{{ Breadcrumbs::create(array(array('title' => 'Groups', 'link' => "dashboard/groups", 'icon' => 'glyphicon-list-alt'))); }}
<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-10">
            <section class="module">
                <div class="module-head">
                    <b>All groups</b>
                </div>
                <div class="module-body ajax-content">
                     @include('syntara::group.list-groups')
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
                            <label for="groupIdSearch">Group id :</label>
                            <input type="text" class="form-control" id="groupIdSearch" name="groupIdSearch">
                        </div>
                        <div class="form-group">
                            <label for="groupnameSearch">Group name :</label>
                            <input type="text" class="form-control" id="groupnameSearch" name="groupnameSearch">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@stop