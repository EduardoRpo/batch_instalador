<?php
session_start();

if (empty($_SESSION['active'])) {
  header('location: ../');
} else if ($_SESSION['rol'] != 1) {
  if ($_SESSION['idModulo'] != 6) {
    session_destroy();
    header('location: ../../');
  }
}
