<div class="row upper-menu">
    {{ $permissions->links(); }}
    
    <div style="float:right;">
        @if($currentUser->hasAccess('permissions-management'))
        <a id="delete-item" class="btn btn-danger">Delete</a>
        @endif

        @if($currentUser->hasAccess('permissions-management'))
        <a class="btn btn-info" href="permission/new">New Permission</a>
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
        <th class="col-lg-1">Name</th>
        <th class="col-lg-2">Value</th>
        <th class="col-lg-2">Description</th>
        @if($currentUser->hasAccess('permissions-management'))
        <th class="col-lg-1" style="text-align: center;">Show</th>
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
        <td style="text-align: center;">&nbsp;<a href="permission/{{ $permission->getId() }}">show</a></td>
        @endif
    </tr>
    @endforeach
</tbody>
</table>