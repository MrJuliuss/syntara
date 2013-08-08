<div class="row upper-menu" style="height: 35px;">
    {{ $users->links() }}
    
    <div style="float:right;">
        <a id="delete-item" class="btn btn-danger users">Delete</a>
    </div>
</div>

<table class="table table-striped table-bordered table-condensed">
<thead>
    <tr>
        <th style="width:20px; text-align: center;"><input type="checkbox" class="check-all"></th>
        <th style="width:20px; text-align: center;">Id</th>
        <th style="width:200px;">Username</th>
        <th style="width:30px; text-align: center;">Show</th>
    </tr>
</thead>
<tbody>
    @foreach ($users as $user)
    <tr>
        <td style="text-align: center;">
            <input type="checkbox" data-user-id="{{ $user->getId() }}">
        </td>
        <td style="text-align: center;">{{ $user->getId() }}</td>
        <td>&nbsp;{{ $user->username }}</td>
        <td style="text-align: center;">&nbsp;<a href="/dashboard/user/{{ $user->getId() }}">show</a></td>
    </tr>
    @endforeach
</tbody>
</table>