@extends('syntara::layouts.dashboard.master')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/group.js') }}"></script> 
{{ Breadcrumbs::create(array(array('title' => 'Groups', 'link' => "dashboard/groups", 'icon' => 'glyphicon-list-alt'), array('title' => $group->name, 'link' => URL::current(), 'icon' => ''))); }}

<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-6">
            <section class="module">
                <div class="module-head">
                    <b>{{ $group->getId() }} - {{ $group->name }}</b>
                </div>
                <div class="module-body">
                    
                </div>
            </section>
        </div>
        <div class="col-lg-6">
            <section class="module">
            <div class="module-head">
                <b></b>
            </div>
            <div class="module-body">
            </div>
        </div>
    </div>
</div>
@stop
