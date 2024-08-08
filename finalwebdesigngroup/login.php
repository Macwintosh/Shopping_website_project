<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style2.css">
</head>
<body>

  <main>
    <section class="login-container">
      <h2>Welcome Back</h2>

      <form action="logins.php" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="uname" placeholder="Enter Username" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="psw" placeholder="Enter Password" required>
        </div>

        <div class="form-group remember-me">
          <input type="checkbox" id="remember-me">
          <label for="remember-me">Remember Me</label>
        </div>

        <button type="submit" class="login-btn">Login</button>
		<button type="button" class="forgot-password-btn" onclick="window.location.href='signup.php'">Sign Up Here</button>

      </form>
    </section>
  </main>

  <script src="script.js"></script>
</body>
</html>
	