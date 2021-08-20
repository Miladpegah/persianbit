<!DOCTYPE html>
<html>
<head>
	<title>Confirm your email</title>
</head>
<body>
	<h1>Tanks for signing up!</h1>
	<p>
		you need to <a href='{{ url("register/confirm/{$user->id}/{$user->verify_token}") }}'>confirm your email address</a>
	</p>
</body>
</html>