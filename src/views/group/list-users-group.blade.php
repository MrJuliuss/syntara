<div class="row upper-menu" style="height: 35px;">
    {{ $users->links() }}

    <div style="float:right;">
        <a id="delete-item" class="btn btn-danger users">Delete</a>
    </div>
</div>

<table class="table table-striped table-bordered table-condensed">
<thead>
    <tr>
        @if($currentUser->hasAccess('user-group-management'))
        <th style="width:20px; text-align: center;"><input type="checkbox" class="check-all"></th>
        @endif
        <th style="width:20px; text-align: center;">ID</th>
        <th style="width:200px;">Username</th>
        <th style="width:30px; text-align: center;">Show</th>
    </tr>
</thead>
<tbody>
    @foreach ($users as $user)
    <tr>
        @if($currentUser->hasAccess('user-group-management'))
        <td style="text-align: center;">
            <input type="checkbox" data-user-id="{{ $user->getId() }}">
        </td>
        @endif
        <td style="text-align: center;">{{ $user->getId() }}</td>
        <td>&nbsp;{{ $user->username }}</td>
        <td style="text-align: center;">&nbsp;<a href="/dashboard/user/{{ $user->getId() }}">show</a></td>
    </tr>
    @endforeach
</tbody>
</table>

@if(!empty($candidateUsers) && $currentUser->hasAccess('user-group-management'))
<div class="row">
    <div class="col-lg-6" style="margin-bottom: 15px;">
        <select class="form-control" id="ungrouped-users-list" data-group-id="{{ $group->getId() }}">
            @foreach($candidateUsers as $user)
            <option value="{{ $user->getId() }}">{{ $user->username}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-4">
        <button id="add-user" type="button" class="btn btn-primary">Add user</button>
    </div>
</div>
@endif
