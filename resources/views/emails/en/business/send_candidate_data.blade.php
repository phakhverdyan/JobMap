<body>
User {{ $data->first_name.' '. $data->last_name }}
Email {{ $data->email }}
Birth Date {{ $data->birth_date }}
City {{ $data->city }}
Country {{ $data->country }}

link to public profile <a href="{{ url('/') . '/u/' . $data->username }}">{{ url('/') . '/u/' . $data->username }}</a>
@if ($data->attach_file)
    link to download user attach file <a download href="{{ url('/') . '/resume/' . $data->id . '/' . $data->attach_file }}">{{ url('/') . '/resume/' . $data->id . '/' . $data->attach_file }}</a>
@endif
link to download pdf user profile <a href="{{ url('/') . '/u-pdf/' . $data->username }}">{{ url('/') . '/u-pdf/' . $data->username }}</a>
{{--link to download pdf user profile <a href="{{ url('/') . '/u-pdf/' . $data->username . '?lang=fr' }}">{{ url('/') . '/u-pdf/' . $data->username . '?lang=fr' }}</a>--}}

</body>