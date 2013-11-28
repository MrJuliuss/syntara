@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/permission.js') }}"></script>
@include('syntara::layouts.dashboard.confirmation-modal',  array('title' => trans('syntara::all.confirm-delete-title'), 'content' => trans('syntara::all.confirm-delete-message'), 'type' => 'delete-permission'))
<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-10">
            <section class="module">
                <div class="module-head">
                    <b>{{ trans('syntara::permissions.all') }}</b>
                </div>
                <div class="module-body ajax-content">
                    @include('syntara::permission.list-permissions')
                </div>
            </section>
        </div>
        <div class="col-lg-2">
            <section class="module">
                <div class="module-head">
                    <b>{{ trans('syntara::all.search') }}</b>
                </div>
                <div class="module-body">
                    <form id="search-form" onsubmit="return false;">
                        <div class="form-group">
                            <label for="permissionIdSearch">{{ trans('syntara::permissions.id') }}</label>
                            <input type="text" class="form-control" id="permissionIdSearch" name="permissionIdSearch">
                        </div>
                        <div class="form-group">
                            <label for="permissionNameSearch">{{ trans('syntara::all.name') }}</label>
                            <input type="text" class="form-control" id="permissionNameSearch" name="permissionNameSearch">
                        </div>
                        <div class="form-group">
                            <label for="permissionValueSearch">{{ trans('syntara::permissions.value') }}</label>
                            <input type="text" class="form-control" id="permissionValueSearch" name="permissionValueSearch">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ trans('syntara::all.search') }}</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@stop