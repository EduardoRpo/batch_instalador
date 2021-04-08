<?php
  ob_start();
  require('../conexion.php');
  $noreferencia = "";
  $fechahoy = "";
  $fechaprogramacion = "";
  $numerodelote = "";
  $tamanototallote = "";
  $tamanolotepresentacion = "";
  $unidadesxlote = "";
  $update = false;
  
  if (isset($_POST['save'])) {
    $noreferencia = $_POST['noreferencia'];
    $fechahoy = $_POST['fechahoy'];
    if (isset($_POST['fechaprogramacion']) && $_POST["fechaprogramacion"] != "") {
      $fechaprogramacion = $_POST['fechaprogramacion'];
    } else {
      $fechaprogramacion = null;
    }


    $numerodelote = $_POST['numerodelote'];
    $tamanototallote = $_POST['tamanototallote'];
    $tamanolotepresentacion = $_POST['tamanolotepresentacion'];
    $unidadesxlote = $_POST['unidadesxlote'];
    $estado = $_POST["numerodelote"];
    echo $estado;

    $query = "INSERT INTO batch (fecha_creacion, fecha_programacion, fecha_actual, numero_orden, numero_lote, tamano_lote, lote_presentacion, unidad_lote, estado, id_producto) 
			VALUES ('$fechahoy',";
    $query .= $fechaprogramacion != null ? "'$fechaprogramacion'" : "NULL";
    $query .= ",'$fechahoy', 'OP012020',' X0010320', '$tamanototallote', '$tamanolotepresentacion', '$unidadesxlote', '$estado', '$noreferencia')";
    echo $query;
    $create = mysqli_query($conn, $query) or die ("Problemas al insertar" . mysqli_error($conn));
    header('location: crear-batch.php');
  }
  if (isset($_POST['update'])) {

    $idbatch = $_POST['idbatch'];
    $noreferencia = $_POST['noreferencia'];
    $fechahoy = $_POST['fechahoy'];
    $fechaprogramacion = $_POST['fechaprogramacion'];
    $numerodelote = $_POST['numerodelote'];
    $tamanototallote = $_POST['tamanototallote'];
    $tamanolotepresentacion = $_POST['tamanolotepresentacion'];
    $unidadesxlote = $_POST['unidadesxlote'];
    
    $modify = mysqli_query($conn, "UPDATE batch SET fecha_creacion='$fechahoy', fecha_programacion='$fechaprogramacion', numero_orden='OP" . $idbatch . "2020', numero_lote='X0" . $idbatch . "20', tamano_lote='$tamanototallote', lote_presentacion='$tamanolotepresentacion', unidad_lote='$unidadesxlote', estado='$numerodelote',  id_producto='$noreferencia' WHERE id_batch=$idbatch");
    $_SESSION['message'] = "Address updated!";
    
    header('location: crear-batch.php');
  }
  if (isset($_GET['del'])) {
    $idbatch = $_GET['del'];
    if(mysqli_query($conn, "DELETE FROM batch WHERE id_batch=$idbatch")){
     echo true;
    }else{
      echo false;
    }
    $_SESSION['message'] = "Address deleted!";
  }
  ob_end_flush();
?>