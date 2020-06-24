<body>
To change the password, go to the link <a href="{{ env('APP_URL',url('/')) }}/user/change_password?rt={{ $user['remember_token'] }}">{{ env('APP_URL',url('/')) }}/user/change_password?rt={{ $user['remember_token'] }}</a>
<br>
if you don't want to change the password ignore this message
</body>