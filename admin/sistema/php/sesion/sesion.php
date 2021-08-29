<?php
session_start();

if (empty($_SESSION['active'])) {
  header('location: ../../');
} else if (isset($_SESSION["timeout"])) {
  $inactividad = 1500;
  $sessionTTL = time() - $_SESSION["timeout"];

  if ($sessionTTL > $inactividad) {
    session_destroy();
    header('location: ../..');
  }
} else if ($_SESSION['rol'] !== 1) {
  session_destroy();
  header('location: ../../');
}
