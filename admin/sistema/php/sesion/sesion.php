<?php
session_start();
 
if (!empty($_SESSION['estado'])) {
  header('location: ../../');
} /* else if ($_SESSION['rol'] !== 1) {
  session_destroy();
  header('location: ../../');
} */