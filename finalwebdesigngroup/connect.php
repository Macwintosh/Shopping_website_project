<?php
$servername = "localhost";
$db_name = "blog_samples";
$username = "root";
$password = "";
 
// create connection
$conn = new mysqli($servername, $username, $password);
 
// test connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
?>
