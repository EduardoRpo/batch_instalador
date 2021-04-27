<?php
session_start();

if (empty($_SESSION['active'])) {
  header('location: ../');
} else if ($_SESSION['idModulo'] != 2) {
  session_destroy();
  header('location: ../../');
}

