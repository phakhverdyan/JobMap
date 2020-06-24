<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

    <p>On the site the user left you a message</p>
    <p> language : {{ $data['language'] }} </p>
    <p> type : {{ $data['type'] }} </p>
    <p> subject : {{ $data['subject'] }} </p>
    <p> email : {{ $data['email'] }} </p>
    <p> phone : {{ $data['phone'] }} </p>
    <p> full_name : {{ $data['full_name'] }} </p>
    <p> message : {!! $data['message'] !!} </p>

</body>
</html>