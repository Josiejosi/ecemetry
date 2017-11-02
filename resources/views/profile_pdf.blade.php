<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PDF</title>

		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	</head>
	<body>
		<h1 class="text-center">User Profile</h1>

		<table class="table table-striped table-hover" cellpadding="5" cellspacing="5" border="1">
			<thead>
				<tr>
					<th>Profile Image</th>
					<th colspan="2">User Details</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td rowspan="5">
						<img src="{{ $profile_pic }}" width="150px" height="150px">
					</td>
					<td>Username</td>
					<td>: {{ $user->username }}</td>
				</tr>
				<tr>
					<td>Names</td>
					<td>: {{ $user->name }} {{ $user->surname }}</td>
				</tr>
				<tr>
					<td>Date of Birth</td>
					<td>: {{ $user->dob }}</td>
				</tr>
				<tr>
					<td>Cause of Death</td>
					<td>: {{ $user->cause_of_death }}</td>
				</tr>
				<tr>
					<td>Summary</td>
					<td>: {{ $user->summary }}</td>
				</tr>
			</tbody>
		</table>

		<script src="{{ asset('js/app.js') }}"></script>
	</body>
</html>