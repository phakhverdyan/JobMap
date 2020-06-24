<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Candidates</title>
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
	<div style="margin-bottom: 10px;">
		Total Jobs: {{ $total_count_of_jobs }} / Jobs on Google: {{ $count_of_jobs_on_google }}
	</div>
	<table>
		<thead>
			<th>ID</th>
			<th>Business Logo</th>
			<th>Business Name</th>
			<th>Business Owner Phone</th>
			<th>Business Address</th>
			<th>Applied At</th>
			<th>Applicant Logo</th>
			<th>Applicant Name</th>
			<th>Applicant Email</th>
			<th>Applicant Address</th>
			<th>Applicant Video</th>
			<th>Applicant Source</th>
		</thead>
		<tbody>
			@foreach ($candidates as $candidate)
				<tr>
					<td>{{ $candidate->id }}</td>
					<td style="padding: 10px;">
						<img src="{{ $candidate->business->image_url }}" style="width: 80px; height: 80px;" alt="">
					</td>
					<td>{{ $candidate->business->name }}</td>
					<td>{{ $candidate->business->phone_code }} {{ $candidate->business->phone }}</td>
					<td>
						{{ $candidate->business->street_number }} {{ $candidate->business->street }},
						{{ $candidate->business->city }}, {{ $candidate->business->region }}, {{ $candidate->business->country }}
					</td>
					@if (date('d.m.Y') == date('d.m.Y', $candidate->created_at->getTimestamp()))
						<td>Today, {{ date('h:i:s a', $candidate->created_at->getTimestamp()) }}</td>
					@elseif (date('d.m.Y', time() - 86400 * 1) == date('d.m.Y', $candidate->created_at->getTimestamp()))
						<td>Yesterday, {{ date('h:i:s a', $candidate->created_at->getTimestamp()) }}</td>
					@elseif (date('d.m.Y', time() - 86400 * 2) == date('d.m.Y', $candidate->created_at->getTimestamp()))
						<td>2 days ago, {{ date('h:i:s a', $candidate->created_at->getTimestamp()) }}</td>
					@elseif (date('d.m.Y', time() - 86400 * 3) == date('d.m.Y', $candidate->created_at->getTimestamp()))
						<td>3 days ago, {{ date('h:i:s a', $candidate->created_at->getTimestamp()) }}</td>
					@else
						<td>{{ date('j M Y \a\t h:i:s a', $candidate->created_at->getTimestamp()) }}</td>
					@endif
					<td style="padding: 10px;">
						<img src="{{ $candidate->user->image_url }}" style="width: 80px; height: 80px;" alt="">
					</td>
					<td>{{ $candidate->user->first_name ?? 'NO' }} {{ $candidate->user->last_name ?? 'NO' }}</td>
					<td>{{ $candidate->user->email }}</td>
					<td>
						{{ $candidate->user->street_number }} {{ $candidate->user->street }},
						{{ $candidate->user->city }}, {{ $candidate->user->region }}, {{ $candidate->user->country }}
					</td>
					<td>
						@if ($candidate->user_video)
							<a href="{{ $candidate->user_video->file_url }}">
								<img src="{{ $candidate->user_video->thumbnail_url }}" alt="" style="width: 100px; height: 100px;">
							</a>
						@else
							no selfie video
						@endif
					</td>
					<td>{{ $candidate->source ?? 'WEB' }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div style="text-align: center; font-size: 20px;">{{ $candidates->links() }}</div>
</body>
</html>