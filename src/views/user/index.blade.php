@extends('syntara::layouts.dashboard.master')

@section('content')
<link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/dashboard/users.css') }}" />
{{ Breadcrumbs::create(array(array('title' => 'Users', 'link' => "dashboard/users", 'icon' => 'icon-user'))); }}

<section class="module">
    <div class="module-head">
        <b>All users</b>
    </div>
    <div class="module-body ajax-content">
        @include('syntara::user.list-users')
    </div>
</section>
@stop