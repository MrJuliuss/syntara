@extends('syntara::layouts.dashboard.master')

@section('content')
{{ Breadcrumbs::create(array(array('title' => 'My Dashboard', 'link' => 'dashboard', 'icon' => 'icon-home'))); }}

{{ $users->links() }}

@foreach ($users as $user)
    {{ $user->getLogin() }}
@endforeach

@stop