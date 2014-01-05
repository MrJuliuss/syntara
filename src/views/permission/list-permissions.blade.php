<div class="row upper-menu">
    {{ $permissions->links(); }}
    
    <div style="float:right;">
        @if($currentUser->hasAccess('permissions-management'))
        <a id="delete-item" class="btn btn-danger">{{ trans('syntara::all.delete') }}</a>
        @endif

        @if($currentUser->hasAccess('permissions-management'))
        <a class="btn btn-info btn-new" href="{{ URL::route('newPermission') }}">{{ trans('syntara::permissions.new') }}</a>
        @endif
    </div>
</div>
<table class="table table-striped table-bordered table-condensed">
<thead>
    <tr>
        @if($currentUser->hasAccess('permissions-management'))
        <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
        @endif
        <th class="col-lg-1" style="text-align: center;">Id</th>
        <th class="col-lg-1">{{ trans('syntara::all.name') }}</th>
        <th class="col-lg-2">{{ trans('syntara::permissions.value') }}</th>
        <th class="col-lg-2">{{ trans('syntara::permissions.description') }}</th>
        @if($currentUser->hasAccess('permissions-management'))
        <th class="col-lg-1" style="text-align: center;">{{ trans('syntara::all.show') }}</th>
        @endif
    </tr>
</thead>
<tbody>
    @foreach ($permissions as $permission)
    <tr>
        @if($currentUser->hasAccess('permissions-management'))
        <td style="text-align: center;">
            <input type="checkbox" data-permission-id="{{ $permission->getId(); }}">
        </td>
        @endif
        <td style="text-align: center;">{{ $permission->getId() }}</td>
        <td>&nbsp;{{ $permission->getName() }}</td>
        <td>&nbsp;{{ $permission->getValue() }}</td>
        <td>&nbsp;{{ $permission->getDescription() }}</td>
        @if($currentUser->hasAccess('permissions-management'))
        <td style="text-align: center;">&nbsp;<a href="{{ URL::route('showPermission', $permission->getId()) }}">{{ trans('syntara::all.show') }}</a></td>
        @endif
    </tr>
    @endforeach
</tbody>
</table>