The new email is successfully confirmed!

<script>
    var userData = JSON.parse(localStorage.getItem('user'));

    if (userData && userData['email'] === '{{ $previous_user_email }}') {
    	userData['email'] = '{{ $current_user_email }}';
    	localStorage.setItem('user', JSON.stringify(userData));
	}
</script>