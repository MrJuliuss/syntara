<div class="row upper-menu">
	{{ $datas['users']->links(); }}
    
    <div style="float:right;">
        <a id="delete-users" class="btn btn-danger btn-vertical-list">Delete</a>
        <a class="btn btn-info btn-vertical-list" href="user/new">New User</a>
    </div>
</div>
<table class="table table-striped table-bordered table-condensed">
<thead>
    <tr>
        <th style="width:20px; text-align: center;"><input type="checkbox" class="check-all"></th>
        <th style="width:20px; text-align: center;">Id</th>
        <th style="width:200px;">Username</th>
        <th style="width:200px;">Email</th>
        <th style="width:200px;" class="hidden-phone">Last Name</th>
        <th style="width:200px;" class="hidden-phone">First Name</th>
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
        <td class="hidden-phone">&nbsp;{{ $user->last_name }}</td>
        <td class="hidden-phone">&nbsp;{{ $user->first_name }}</td>
        <td style="text-align: center;">&nbsp;<a href="user/{{ $user->getId() }}">show</a></td>
    </tr>
    @endforeach
</tbody>
</table>