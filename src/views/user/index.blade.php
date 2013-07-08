@extends('syntara::layouts.dashboard.master')

@section('content')
{{ Breadcrumbs::create(array(array('title' => 'Users', 'link' => 'dashboard/users', 'icon' => 'icon-user'))); }}
<div class="span10">
		<table class="table table-bordered">
			<thead>
				<tr role="row">
					<th style="width:20px;">
						<div>Id</div>
					</th>
					<th style="width: 304px;">
						<div>Email</div>
					</th>
					<th style="width: 300px;">
						<div >Last Name</div>
					</th>
					<th style="width: 273px;">
						<div >First Name</div>
					</th>
				</tr>
			</thead>

			@foreach ($users as $user)
				<tbody>
				<tr>
					<td><input type="checkbox" ></td>
					<td>{{ $user->getId() }}</td>
					<td>{{ $user->getLogin() }}</td>
					<td>Test</td>
				</tr>
				</tbody>
			@endforeach
		</table>
		{{ $users->links() }}
</div>




@stop
