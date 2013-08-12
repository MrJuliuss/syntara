<div class="row upper-menu">
    {{ $datas['users']->links(); }}
    
    <div style="float:right;">
        <a id="delete-item" class="btn btn-danger">Delete</a>
        <a class="btn btn-info" href="user/new">New User</a>
    </div>
</div>
<table class="table table-striped table-bordered table-condensed">
<thead>
    <tr>
        <th style="width:20px; text-align: center;"><input type="checkbox" class="check-all"></th>
        <th style="width:20px; text-align: center;">Id</th>
        <th style="width:200px;">Username</th>
        <th style="width:200px;">Email</th>
        <th style="width:200px;">Groups</th>
        <th style="width:200px;" class="hidden-sm">Last Name</th>
        <th style="width:200px;" class="hidden-sm">First Name</th>
        <th style="width:30px; text-align: center;">Show</th>
    </tr>
</thead>
<tbody>
    @foreach ($datas['users'] as $user)
    <tr>
        <td style="text-align: center;">
            <input type="checkbox" data-user-id="{{ $user->getId(); }}">
        </td>
        <td style="text-align: center;">{{ $user->getId() }}</td>
        <td>&nbsp;{{ $user->username }}</td>
        <td>&nbsp;{{ $user->getLogin() }}</td>
        <td>
        @foreach($user->getGroups()->toArray() as $key => $group)
            {{ $group['name'] }},
        @endforeach
        </td>
        <td class="hidden-sm">&nbsp;{{ $user->last_name }}</td>
        <td class="hidden-sm">&nbsp;{{ $user->first_name }}</td>
        <td style="text-align: center;">&nbsp;<a href="user/{{ $user->getId() }}">show</a></td>
    </tr>
    @endforeach
</tbody>
</table>