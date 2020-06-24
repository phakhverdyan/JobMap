<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Businesses</title>
	<style type="text/css">
		table {
			border-collapse: collapse;
			border: 1px solid #e4e4e4;
		}

		th {
			padding: 10px;
			font-weight: bold;
			border: 1px solid #e4e4e4;
		}

		td {
			padding: 10px;
			border: 1px solid #e4e4e4;
		}

		.pagination li {
			display: inline-block;
			vertical-align: top;
		}
	</style>
</head>
<body>
	<table>
		<thead>
			<th>ID</th>
			<th>Logo</th>
			<th>Name</th>
			<th>Created At</th>
			<th>Owner Name</th>
			<th>Owner Email</th>
			<th>Owner Phone</th>
			<th>Location Address</th>
		</thead>
		<tbody>
			@foreach ($businesses as $business)
				<tr>
					<td>{{ $business->id }}</td>
					<td style="padding: 10px;">
						<img src="{{ $business->image_url }}" style="width: 80px; height: 80px;" alt="">
					</td>
					<td>{{ $business->name }}</td>
					@if (date('d.m.Y') == date('d.m.Y', $business->created_at->getTimestamp()))
						<td>Today</td>
					@elseif (date('d.m.Y', time() - 86400 * 1) == date('d.m.Y', $business->created_at->getTimestamp()))
						<td>Yesterday</td>
					@elseif (date('d.m.Y', time() - 86400 * 2) == date('d.m.Y', $business->created_at->getTimestamp()))
						<td>2 days ago</td>
					@elseif (date('d.m.Y', time() - 86400 * 3) == date('d.m.Y', $business->created_at->getTimestamp()))
						<td>3 days ago</td>
					@else
						<td>{{ date('j M Y \a\t h:i:s a', $business->created_at->getTimestamp()) }}</td>
					@endif
					<td>{{ $business->admin->user->first_name ?? 'NO' }} {{ $business->admin->user->last_name ?? 'NO' }}</td>
					<td>{{ $business->admin->user->email }}</td>
					<td>{{ $business->phone_code }} {{ $business->phone }}</td>
					<td>
						{{ $business->street_number }} {{ $business->street }},
						{{ $business->city }}, {{ $business->region }}, {{ $business->country }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div style="text-align: center; font-size: 20px;">{{ $businesses->links() }}</div>
</body>
</html>