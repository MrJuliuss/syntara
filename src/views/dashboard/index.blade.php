@extends('syntara::layouts.dashboard.master')

@section('title', 'Index')

@section('content')
{{ Breadcrumbs::create(array(array('title' => 'My Dashboard', 'link' => 'dashboard', 'icon' => 'glyphicon-home'))); }}
@stop