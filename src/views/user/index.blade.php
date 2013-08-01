@extends('syntara::layouts.dashboard.master')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script> 
{{ Breadcrumbs::create(array(array('title' => 'Users', 'link' => "dashboard/users", 'icon' => 'icon-user'))); }}
<div class="container" id="main-container">
    <div class="row">
        <!--<div class="col-lg-12">-->
            <section class="module">
                <div class="module-head">
                    <b>All users</b>
                </div>
                <div class="module-body ajax-content">
                    @include('syntara::user.list-users')
                </div>
            </section>
        <!--</div>-->
    </div>
</div>
@stop