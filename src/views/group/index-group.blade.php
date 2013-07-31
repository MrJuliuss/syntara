@extends('syntara::layouts.dashboard.master')

@section('content')
{{ Breadcrumbs::create(array(array('title' => 'Groups', 'link' => "dashboard/groups", 'icon' => 'icon-list-alt'))); }}
<div class="container" id="main-container">
    <div class="row">
        <section class="module">
            <div class="module-head">
                <b>All groups</b>
            </div>
            <div class="module-body ajax-content">
            </div>
        </section>
    </div>
</div>
@stop