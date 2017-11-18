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

        <p class="text-center"><a href="{{ $qrcode_url }}">{{ $qrcode_url }}</a></p>
        <div class="text-center" id="qrcode_url"></div>

		<table width="100%" cellpadding="15" cellspacing="5" border="1">
			<thead>
				<tr>
					<th><h3 class="text-center">Profile Image</h3></th>
					<th colspan="2"><h3 class="text-center">User Details</h3></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td rowspan="6">
						<img src="{{ $profile_pic }}" align="center" width="250px" height="250px">
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
					<td>Date of Birth</td>
					<td>: {{ $user->dod }}</td>
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

	    <script src="{{ asset( 'js/jquery-qrcode-0.14.0.min.js' ) }}"></script>

	    <script>
	        
	        $(function(){
	            var options = {
	            	render: 'div',
	                text: '{{ $qrcode_url }}'
	            };

	            $("#qrcode_url").qrcode(options);
	        });
    </script>
	</body>
</html>