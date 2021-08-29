<?php
session_start();
function sesiones($modulo)
{
  if (empty($_SESSION['active'])) {
    header('location: ../');
  } else if ($_SESSION['rol'] != 1  && $_SESSION['rol'] != 2 && $_SESSION['rol'] != 4) {
    if ($_SESSION['idModulo'] != $modulo) {
      session_destroy();
      header('location: ../../');
    } else if (isset($_SESSION["timeout"])) {
      $inactividad = 1500;
      $sessionTTL = time() - $_SESSION["timeout"];

      if ($sessionTTL > $inactividad) {
        session_destroy();
        header('location: ../..');
      }
    }
  } else if (isset($_SESSION["timeout"])) {
    $inactividad = 1500;
    $sessionTTL = time() - $_SESSION["timeout"];

    if ($sessionTTL > $inactividad) {
      session_destroy();
      header('location: ../..');
    }
  }
}
