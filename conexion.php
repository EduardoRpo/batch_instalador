<?php
require_once __DIR__."/env.php";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
  mysqli_set_charset($conn, "utf-8");
?>