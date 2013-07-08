@extends('syntara::layouts.dashboard.master')

@section('content')
{{ Breadcrumbs::create(array(array('title' => 'Users', 'link' => 'dashboard/users', 'icon' => 'icon-user'))); }}

<section class="module" style="margin: 20px;">
    <div class="module-head">
        <b>All users</b>
    </div>
    <div class="module-body">
        {{ $users->links() }}
        <table class="table table-striped table-bordered table-condensed">
        <thead>
			<tr>
                <th style="width:25px; text-align: center;">#</th>
				<th style="width:30px; text-align: center;">Id</th>
				<th style="width:250px;">Email</th>
				<th style="width:250px;">Last Name</th>
				<th style="width:250px;">First Name</th>
			</tr>
		</thead>
        		
		@foreach ($users as $user)
        <tbody>
        <tr>
            <td style="text-align: center;"><input type="checkbox" ></td>
            <td style="width:30px; text-align: center;">{{ $user->getId() }}</td>
            <td>{{ $user->getLogin() }}</td>
            <td>Test</td>
            <td>Test</td>
        </tr>
        </tbody>
		@endforeach
        </table>
    </div>
</section>
@stop