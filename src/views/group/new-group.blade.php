@extends('syntara::layouts.dashboard.master')

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/group.js') }}"></script>
<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-12">
            <section class="module">
                <div class="module-head">
                    <b>New group</b>
                </div>
                <div class="module-body">
                    <form class="form-horizontal" id="create-group-form" method="POST">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Group name</label>
                                    <input class="col-lg-12 form-control" type="text" id="groupname" name="groupname">
                               </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="control-label">Permissions</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-plus-sign add-input"></span></span>
                                    <select class="form-control permissions-select">
                                        @foreach($permissions as $permission)
                                        <option value="permission[{{ $permission->getValue() }}]">{{ $permission->getName() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="input-container"></div>
                                <br>
                            </div>
                        </div>
                        <div class="row">
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