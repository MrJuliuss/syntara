@extends('syntara::layouts.dashboard.master')

@section('content')
{{ Breadcrumbs::create(array(array('title' => 'My Dashboard', 'link' => 'dashboard', 'icon' => 'icon-home'))); }}
<h1>Index Dashboard</h1>
@stop