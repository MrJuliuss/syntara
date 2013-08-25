<div class="row upper-menu">
    {{ $groups->links(); }}
    
    <div style="float:right;">
        <a id="delete-item" class="btn btn-danger  groups">Delete</a>
        <a class="btn btn-info" href="group/new">New Group</a>
    </div>
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteGroup" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirm deletion</h4>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this(these) group(s) ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirm-delete">Delete group(s)</button>
                </div>
            </div>
        </div>
    </div>
</div>
<table class="table table-striped table-bordered table-condensed">
<thead>
    <tr>
        <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
        <th class="col-lg-1" style="text-align: center;">Id</th>
        <th class="col-lg-2">Name</th>
        <th class="col-lg-7">Permissions</th>
        <th class="col-lg-1" style="text-align: center;">Show</th>
    </tr>
</thead>
<tbody>
    @foreach ($groups as $group)
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