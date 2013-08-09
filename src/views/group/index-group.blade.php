@extends('syntara::layouts.dashboard.master')

@section('title', 'Groups list')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/group.js') }}"></script>
{{ Breadcrumbs::create(array(array('title' => 'Groups', 'link' => "dashboard/groups", 'icon' => 'glyphicon-list-alt'))); }}
<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-12">
            <section class="module">
                <div class="module-head">
                    <b>All groups</b>
                </div>
                <div class="module-body ajax-content">
                     @include('syntara::group.list-groups')
                </div>
            </section>
        </div>
    </div>
</div>
@stop