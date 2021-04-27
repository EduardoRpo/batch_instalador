<?php
session_start();

if (empty($_SESSION['active'])) {
  header('location: ../');
} else if ($_SESSION['idModulo'] != 5) {
  session_destroy();
  header('location: ../../');
}

