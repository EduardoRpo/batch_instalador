<?php
session_start();

if (empty($_SESSION['active'])) {
  header('location: ../');
} else if ($_SESSION['rol'] != 1  && $_SESSION['rol'] != 2 && $_SESSION['rol'] != 3) {
  if ($_SESSION['idModulo'] != 3) {
    session_destroy();
    header('location: ../../');
  }
}
