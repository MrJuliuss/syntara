@extends('syntara::layouts.dashboard.master')

@section('content')
<!--<link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/dashboard/users.css') }}" />-->
{{ Breadcrumbs::create(array(array('title' => 'Groups', 'link' => "dashboard/groups", 'icon' => 'icon-list-alt'), array('title' => 'New group', 'link' => URL::current(), 'icon' => 'icon-plus-sign'))); }}

<div class="container-fluid">
    <div class="row-fluid">
        <section class="module">
            <div class="module-head">
                <b>New group</b>
            </div>
            <div class="module-body">
                <form id="" action="" method="POST">
                   
                </form>
            </div>
        </section>
    </div>
</div>
@stop