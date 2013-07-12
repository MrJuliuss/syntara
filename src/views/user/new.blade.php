@extends('syntara::layouts.dashboard.master')

@section('content')
<link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/dashboard/users.css') }}" />
{{ Breadcrumbs::create(array(array('title' => 'Users', 'link' => "dashboard/users", 'icon' => 'icon-user'), array('title' => 'New user', 'link' => "dashboard/user/new", 'icon' => 'icon-plus-sign'))); }}

<section class="module" style="margin: 20px;">
    <div class="module-head">
    </div>
</section>
@stop