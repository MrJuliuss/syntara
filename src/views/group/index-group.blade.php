@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/group.js') }}"></script>
<div class="container" id="main-container">
 @include('syntara::layouts.dashboard.confirmation-modal',  array('title' => trans('syntara::all.confirm-delete-title'), 'content' => trans('syntara::all.confirm-delete-message'), 'type' => 'delete-group'))
    <div class="row">
        <div class="col-lg-10">
            <section class="module">
                <div class="module-head">
                    <b>{{ trans('syntara::groups.all') }}</b>
                </div>
                <div class="module-body ajax-content">
                     @include('syntara::group.list-groups')
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
                            <label for="groupIdSearch">{{ trans('syntara::groups.id') }}</label>
                            <input type="text" class="form-control" id="groupIdSearch" name="groupIdSearch">
                        </div>
                        <div class="form-group">
                            <label for="groupnameSearch">{{ trans('syntara::groups.name') }}</label>
                            <input type="text" class="form-control" id="groupnameSearch" name="groupnameSearch">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ trans('syntara::all.search') }}</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@stop