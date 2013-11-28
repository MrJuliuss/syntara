@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script>

<div class="container" id="main-container">
    @include('syntara::layouts.dashboard.confirmation-modal', array('title' => trans('syntara::all.confirm-delete-title'), 'content' => trans('syntara::all.confirm-delete-message'), 'type' => 'delete-user'))
    <div class="row">
        <div class="col-lg-10">
            <section class="module">
                <div class="module-head">
                    <b>{{ trans('syntara::users.all') }}</b>
                </div>
                <div class="module-body ajax-content">
                    @include('syntara::user.list-users')
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
                            <label for="userIdSearch">{{ trans('syntara::users.id') }}</label>
                            <input type="text" class="form-control" id="userIdSearch" name="userIdSearch">
                        </div>
                        <div class="form-group">
                            <label for="usernameSearch">{{ trans('syntara::users.username') }}</label>
                            <input type="text" class="form-control" id="usernameSearch" name="usernameSearch">
                        </div>
                        <div class="form-group">
                            <label for="emailSearch">{{ trans('syntara::all.email') }}</label>
                            <input type="email" class="form-control" id="emailSearch" name="emailSearch">
                        </div>
                        <div class="form-group">
                            <label for="bannedSearch">{{ trans('syntara::users.banned') }}</label>
                            <select class="form-control" id="bannedSearch" name="bannedSearch">
                                <option>--</option>
                                <option value="0">{{ trans('syntara::all.no') }}</option>
                                <option value="1">{{ trans('syntara::all.yes') }}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ trans('syntara::all.search') }}</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@stop