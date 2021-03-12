<div class="container" style="background:#fff">

    <h1>Welcome to TheShop</h1>

<form method="post" action="/login">
    @csrf

<div class="form-group">
    <label>Email Address</label>
    <input class="form-control" name="email" type="text" />
</div>

<div class="form-group">
    <label>Password</label>
    <input class="form-control" name="password" type="password" />
</div>

<p>
    <input class="btn btn-default" type="submit" name="submit" value="Log In" />
</p>

</form>

</div>
