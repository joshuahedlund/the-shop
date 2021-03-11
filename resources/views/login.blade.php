<!doctype html>
<html>
<head>
    <title>Login | TheShop</title>
</head>
<body>

<form method="post" action="/login">
<h1>Login</h1>

<!-- if there are login errors, show them here -->
<p>
    {{ $errors->first('email') }}
    {{ $errors->first('password') }}
</p>

<p>
    <label>Email Address</label>
    <input name="email" type="text" />
</p>

<p>
    <label>Password</label>
    <input name="password" type="password" />
</p>

<p>
    <input type="submit" name="submit" value="Log In" />
</p>

</form>
