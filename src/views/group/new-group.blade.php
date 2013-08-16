@extends('syntara::layouts.dashboard.master')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/group.js') }}"></script>
{{ Breadcrumbs::create(array(array('title' => 'Groups', 'link' => "dashboard/groups", 'icon' => 'glyphicon-list-alt'), array('title' => 'New group', 'link' => URL::current(), 'icon' => 'glyphicon-plus-sign'))); }}

<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-6">
            <section class="module">
                <div class="module-head">
                    <b>New group</b>
                </div>
                <div class="module-body">
                    <form class="form-horizontal" id="create-group-form" method="POST">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                   <label class="control-label">Group name :</label>
                                    <input class="col-lg-12 form-control" type="text" id="groupname" name="groupname">
                               </div>
                            </div>
                            <div class="col-lg-6" id="input-container">
                                <div class="form-group">
                                <label class="control-label">Permissions :</a></label>
                                <p class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-plus-sign add-input"></span></span>
                                    <input type="text" class="form-control" name="permission[1]" />
                                </p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="control-group">
                                    <button id="create-group" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@stop