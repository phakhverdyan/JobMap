<body>
You have come to the request "Leave a review" from {{ $reference['full_name'] }},
<br>
To leave the call out to go through the link <a href="{{ env('APP_URL',url('/')) }}/user/reference?t={{ $reference['remember_token'] }}">{{ env('APP_URL',url('/')) }}/user/reference?t={{ $reference['remember_token'] }}</a>
<br>
if you do not want to change the password do not do anything
</body>