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
        <form action="{{ url('/register') }}" method="GET">
          <h2>Register for an Account</h2>

            <div class="form-group">
                <div class="label-wrapper">
                <label for="name">FULL NAME</label>
                </div>
                <input id="name" type="text" name="name" required autocomplete="name">
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input id="email" type="email" name="email" required autocomplete="email">
            </div>

            <div class="form-group">
                <div class="label-wrapper">
                    <label for="whatsapp">WhatsApp Number</label>
                </div>
                <input id="whatsapp" type="text" name="whatsapp" required autocomplete="whatsapp">
            </div>

            <div class="form-group">
                <div class="label-wrapper">
                    <label for="password">Password</label>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password">
            </div>
        
            <div class="form-group">
                <button type="submit" class="btn-submit">Register</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
