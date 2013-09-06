@extends('syntara::layouts.dashboard.master')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/permission.js') }}"></script>
<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-6">
            <section class="module">
                <div class="module-head">
                    <b>New permission</b>
                </div>
                <div class="module-body">
                    <form class="form-horizontal" id="create-permission-form" method="POST">
                        <div class="row">
                            <div class="col-lg-12">
                                 <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <p><input class="col-lg-12 form-control" type="text" placeholder="Permission name" id="name" name="name"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Value</label>
                                    <p><input class="col-lg-12 form-control" type="text" placeholder="Permission value" id="value" name="value"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <p><input class="col-lg-12 form-control" type="text" placeholder="Permission description" id="description" name="description"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <button id="add-permission" class="btn btn-primary" style="margin-top: 15px;">Create</button>
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