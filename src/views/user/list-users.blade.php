<div class="row upper-menu">
	{{ $datas['users']->links(); }}
</div>
<table class="table table-striped table-bordered table-condensed">
<thead>
    <tr>
        <th style="width:25px; text-align: center;"><input type="checkbox" class="check-all"></th>
        <th style="width:30px; text-align: center;">Id</th>
        <th style="width:250px;">Email</th>
        <th style="width:250px;">Last Name</th>
        <th style="width:250px;">First Name</th>
    </tr>
</thead>
<tbody>
    @foreach ($datas['users'] as $user)
    <tr>
        <td style="text-align: center;"><input type="checkbox" ></td>
        <td style="width:30px; text-align: center;">{{ $user->getId() }}</td>
        <td>{{ $user->getLogin() }}</td>
        <td>Test</td>
        <td>Test</td>
    </tr>
    @endforeach
</tbody>
</table>