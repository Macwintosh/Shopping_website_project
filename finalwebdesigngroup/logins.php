<?php
session_start();

include("connect.php");
mysqli_select_db($conn, $db_name);

$name = $_POST["uname"];
$pwd = $_POST["psw"];

$sql = "SELECT * FROM login WHERE loginname = ? AND pwd = ?";

// Prepared statement for security (replace with your error handling)
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
  echo "Query preparation failed: " . mysqli_error($conn);
  die();
}

mysqli_stmt_bind_param($stmt, "ss", $name, $pwd); // Bind parameters for username and password

$result = mysqli_stmt_execute($stmt); // Execute the prepared statement
if (!$result) {
  echo "Query execution failed: " . mysqli_error($conn);
  die();
}

$login_successful = false;
$data = mysqli_stmt_get_result($stmt); // Get the result set (if any)
if ($data && mysqli_num_rows($data) > 0) {
  $_SESSION["login"] = mysqli_fetch_assoc($data)['loginname'];
  $login_successful = true;
}

mysqli_stmt_close($stmt); // Close the prepared statement

mysqli_close($conn); // Close the connection

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Result</title>
  <link rel="stylesheet" href="style4.css">
</head>
<body>
  <div class="container">
    <?php if ($login_successful) { ?>
      <h1 style="color: #3498db;">Login Successful!</h1>
      <p>Welcome back, <?php echo $_SESSION["login"]; ?>.</p>
    <?php } else { ?>
      <h2 style="color: #3498db; font-size: 30px;">Login Failed!</h2>
      <p>Username or password is incorrect.</p>
    <?php } ?>
    <div class="actions">
      <a href="index.php" class="button primary">Go to Home Page</a>
    </div>
  </div>
</body>
</html>


