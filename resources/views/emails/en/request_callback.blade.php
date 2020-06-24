<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

    <p>On the site the user left you a request callback</p>
    <p> email : {{ $data['email'] }} </p>
    <p> contact_name : {{ $data['contact_name'] }} </p>
    <p> employer_name : {{ $data['employer_name'] }} </p>
    <p> employer_number : {{ $data['employer_number'] }} </p>
    <p> location_number : {{ $data['location_number'] }} </p>
    <p> phone : {{ $data['phone'] }} </p>
    <p> extension : {{ $data['extension'] }} </p>
    @if ($data['message'])
        <p> message : {{ $data['message'] }} </p>
    @endif
    <p> time : {{ $data['time'] }} </p>
    <p> country : {{ $data['country'] }} </p>
    @if ($data['message'])
        <p> website : {{ $data['website'] }} </p>
    @endif
    @if ($data['business_name'])
        <p> website : {{ $data['business_name'] }} </p>
    @endif
</body>
</html>