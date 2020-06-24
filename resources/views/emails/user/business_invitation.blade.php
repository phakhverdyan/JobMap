<body>
You are invited by {{ $params['business_name'] }}
<br>
Accept invite by this link - <a href="{{ env('APP_URL',url('/')) }}/user/signup?i={{ $user['invite_token'] }}">{{ env('APP_URL',url('/')) }}/user/signup?i={{ $user['invite_token'] }}</a>
</body>