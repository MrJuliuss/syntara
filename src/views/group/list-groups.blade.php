<div class="row upper-menu">
    {{ $groups->links(); }}
    
    <div style="float:right;">
        <a id="delete-item" class="btn btn-danger  groups">{{ trans('syntara::all.delete') }}</a>
        <a class="btn btn-info btn-new" href="{{ URL::route('newGroup') }}">{{ trans('syntara::groups.new') }}</a>
    </div>
    
</div>
<table class="table table-striped table-bordered table-condensed">
<thead>
    <tr>
        <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
        <th class="col-lg-1" style="text-align: center;">Id</th>
        <th class="col-lg-2">{{ trans('syntara::all.name') }}</th>
        <th class="col-lg-7">{{ trans('syntara::navigation.permissions') }}</th>
        <th class="col-lg-1" style="text-align: center;">{{ trans('syntara::all.show') }}</th>
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
        <td style="text-align: center;">&nbsp;<a href="{{ URL::route('showGroup', $group->getId())}}">{{ trans('syntara::all.show') }}</a></td>
    </tr>
    @endforeach
</tbody>
</table>