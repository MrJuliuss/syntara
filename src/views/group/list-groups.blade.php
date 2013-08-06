<div class="row upper-menu">
    {{ $datas['groups']->links(); }}
    
    <div style="float:right;">
        <a id="delete-groups" class="btn btn-danger">Delete</a>
        <a class="btn btn-info" href="group/new">New Group</a>
    </div>
</div>
<table class="table table-striped table-bordered table-condensed">
<thead>
    <tr>
        <th style="width:20px; text-align: center;"><input type="checkbox" class="check-all"></th>
        <th style="width:20px; text-align: center;">Id</th>
        <th style="width:400px;">Group name</th>
        <th style="width:400px;">Permissions</th>
        <th style="width:30px; text-align: center;">Show</th>
    </tr>
</thead>
<tbody>
    @foreach ($datas['groups'] as $group)
    <tr>
        <td style="text-align: center;">
            <input type="checkbox" data-group-id="{{ $group->getId(); }}">
        </td>
        <td style="text-align: center;">{{ $group->getId() }}</td>
        <td>{{ $group->getName() }}</td>
        <td>{{ json_encode($group->getPermissions()) }}</td>
        <td style="text-align: center;">&nbsp;<a href="group/{{ $group->getId() }}">show</a></td>
    </tr>
    @endforeach
</tbody>
</table>