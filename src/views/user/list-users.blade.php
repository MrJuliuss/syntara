<div class="row upper-menu">
    {{ $datas['users']->links(); }}
    
    <div style="float:right;">
        @if($currentUser->hasAccess('delete-user'))
        <a id="delete-item" class="btn btn-danger">Delete</a>
        @endif

        @if($currentUser->hasAccess('create-user'))
        <a class="btn btn-info" href="user/new">New User</a>
        @endif
    </div>
</div>
<table class="table table-striped table-bordered table-condensed">
<thead>
    <tr>
        @if($currentUser->hasAccess('delete-user'))
        <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
        @endif
        <th class="col-lg-1" style="text-align: center;">Id</th>
        <th class="col-lg-1">Username</th>
        <th class="col-lg-2">Email</th>
        <th class="col-lg-2">Groups</th>
        <th class="col-lg-2">Permissions</th>
        <th class="col-lg-1 hidden-sm">Last Name</th>
        <th class="col-lg-1 hidden-sm">First Name</th>
        @if($currentUser->hasAccess('update-user-info'))
        <th class="col-lg-1" style="text-align: center;">Show</th>
        @endif
    </tr>
</thead>
<tbody>
    @foreach ($datas['users'] as $user)
    <tr>
        @if($currentUser->hasAccess('delete-user'))
        <td style="text-align: center;">
            <input type="checkbox" data-user-id="{{ $user->getId(); }}">
        </td>
        @endif
        <td style="text-align: center;">{{ $user->getId() }}</td>
        <td>&nbsp;{{ $user->username }}</td>
        <td>&nbsp;{{ $user->getLogin() }}</td>
        <td>
        @foreach($user->getGroups()->toArray() as $key => $group)
            {{ $group['name'] }},
        @endforeach
        </td>
        <td>{{ json_encode($user->getPermissions()) }}</td>
        <td class="hidden-sm">&nbsp;{{ $user->last_name }}</td>
        <td class="hidden-sm">&nbsp;{{ $user->first_name }}</td>
        @if($currentUser->hasAccess('update-user-info'))
        <td style="text-align: center;">&nbsp;<a href="user/{{ $user->getId() }}">show</a></td>
        @endif
    </tr>
    @endforeach
</tbody>
</table>