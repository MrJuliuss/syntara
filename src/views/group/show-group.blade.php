@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/group.js') }}"></script>
<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-6">
            <section class="module">
                <div class="module-head">
                    <b>{{ $group->getId() }} - {{ $group->name }}</b>
                </div>
                <div class="module-body">
                    <form class="form-horizontal" id="edit-group-form" method="POST">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                   <label class="control-label">{{ trans('syntara::groups.name') }}</label>
                                    <input class="col-lg-12 form-control" type="text" id="groupname" name="groupname" value="{{ $group->name }}">
                               </div>
                            </div>
                             <div class="col-lg-4">
                                @if($currentUser->hasAccess('permissions-management'))
                                    @include('syntara::layouts.dashboard.permissions-select', array('permissions'=> $permissions))
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="control-group">
                                    <button id="update-group" class="btn btn-primary">{{ trans('syntara::all.update') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        <div class="col-lg-6">
            <section class="module">
            <div class="module-head">
                <b>{{ trans('syntara::groups.groups-users-title') }}</b>
            </div>
            <div class="module-body ajax-content">
                 @include('syntara::group.list-users-group')
            </div>
        </div>
    </div>
</div>
@stop
