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
    }
  }
}
