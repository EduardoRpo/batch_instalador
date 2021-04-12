<?php

$path = "../../html/etiquetas/etiquetas_Dispensacion.xlsx";
$path = "C:/Users/sergi/Downloads/etiquetas_Dispensacion.xlsx";
if (file_exists($path)) {
    unlink($path);
    echo 1;
} else {
    echo 0;
}
die;
