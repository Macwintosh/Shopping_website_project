<?php
session_start();

include("connect.php");
mysqli_select_db($conn, $db_name);

$name = $_POST["uname"];
$pwd = $_POST["psw"];

$sql = "INSERT INTO `login`(`loginname`, `pwd`) VALUES ('$name','$pwd')";
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
      <h1 style="color: #3498db;">
        <?php
        if ($conn->query($sql) === TRUE) {
          echo "<h1 style='color: #3498db;'>Signup Successfully</h1>";
          echo "<p>Welcome back, $name</p>";
          $_SESSION["login"] = $name;
        ?>

        <?php } else { ?>

        <?php
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
        ?>
      </h1>
    <div class="actions">
      <a href="index.php" class="button primary">Go to Home Page</a>
    </div>
  </div>
</body>
</html>


