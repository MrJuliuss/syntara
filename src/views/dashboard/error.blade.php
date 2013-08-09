@extends('syntara::layouts.dashboard.master')

@section('title', 'Error')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script> 
{{ Breadcrumbs::create(array(array('title' => 'Dashboard', 'link' => "dashboard", 'icon' => 'glyphicon-home'))); }}

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span6 offset3">
            <section class="module">
                <div class="module-head">
                    <b>Error !</b>
                </div>
                <div class="module-body">
                    <div class="alert alert-error">
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@stop