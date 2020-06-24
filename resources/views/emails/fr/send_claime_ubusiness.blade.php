<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

    <p>On the site the user left you a request for business: {{ $data['business']->name }}, id = {{ $data['business']->id }}</p>
    <p> First Name : {{ $data['first_name'] }} </p>
    <p> Last Name : {{ $data['last_name'] }} </p>
    <p> email : {{ $data['email'] }} </p>
    <p> phone : {{ $data['phone'] }} </p>
    @if ($data['employer_number'])
        <p> employer_number : {{ $data['employer_number'] }} </p>
    @endif
    @if ($data['time'])
        <p> time : {{ $data['time'] }} </p>
    @endif
    @if ($data['message'])
        <p> website : {{ $data['website'] }} </p>
    @endif
</body>
</html>