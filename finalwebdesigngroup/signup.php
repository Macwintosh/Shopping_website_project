<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account - [Your Shop Name]</title>
  <link rel="stylesheet" href="style5.css">
</head>
<body>

  <main>
    <section class="signup-container">
      <h2>Create Account</h2>

      <form action="signups.php" method="post"> <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="uname" placeholder="Enter Username" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="psw" placeholder="Enter Password" required>
        </div>

        <div class="form-group">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
        </div>

        <button type="submit" class="signup-btn">Sign Up</button>
      </form>
    </section>
  </main>
</body>
</html>
