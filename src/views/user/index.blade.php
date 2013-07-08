@extends('syntara::layouts.dashboard.master')

@section('content')
{{ Breadcrumbs::create(array(array('title' => 'Users', 'link' => 'dashboard/users', 'icon' => 'icon-user'))); }}

<section class="module" style="margin: 20px;">
    <div class="module-head">
        <b>All users</b>
    </div>
    <div class="module-body ajax-content">
        @include('syntara::user.list-users')
    </div>
</section>
@stop