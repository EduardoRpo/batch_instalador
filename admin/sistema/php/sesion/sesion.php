<?php
//require_once('../../conexion.php');
session_start();
//echo $_SESSION['active'];
if (empty($_SESSION['active'])) {
  header('location: ../../');
} else if (isset($_SESSION["timeout"])) {
  $inactividad = 150;
  $sessionTTL = time() - $_SESSION["timeout"];

  if ($sessionTTL > $inactividad) {
    session_destroy();
    header('location: ../..');
  }
} else if ($_SESSION['rol'] !== 1) {
  session_destroy();
  header('location: ../../');
}
