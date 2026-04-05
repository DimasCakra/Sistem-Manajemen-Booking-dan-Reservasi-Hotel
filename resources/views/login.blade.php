<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
<link rel="stylesheet" href="{{ asset('css/login.css') }}"><body>

<div class="login-container">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTE5hirGcGYW4VJKa63FFemb3xfb23CdjNJlg&s" alt="Logo">
    <div class="login-content">
        <form action="{{ url('/home') }}" method="GET">
          <h2>Login to Your Account</h2>
            <div class="form-group">
                <label for="email">Email address</label>
                <input id="email" type="email" name="email" required autocomplete="email">
            </div>

            <div class="form-group">
                <div class="label-wrapper">
                    <label for="password">Password</label>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password">
            </div>
            <div class="form-group">
                <div class="checkbox-wrapper">
                    <input id="remember" type="checkbox" name="remember">
                    <label for="remember">Remember me</label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-submit">Login</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
