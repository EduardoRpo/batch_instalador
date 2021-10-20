<?php
require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

$ruta = "c:\pedidos\pedidos.xlsx";
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
$archivoExcel = $reader->load($ruta);

$pedidos = $archivoExcel->getActiveSheet();

$fila = $pedidos->getHighestRow();
$letraColumna = $pedidos->getHighestColumn();

$columna = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($letraColumna);

for ($indiceFila = 2; $indiceFila <= $fila; $indiceFila++) {

	$cliente = $pedidos->getCellByColumnAndRow(1, $indiceFila);
	$nombre = $pedidos->getCellByColumnAndRow(2, $indiceFila);
	$doc = $pedidos->getCellByColumnAndRow(3, $indiceFila);
	$fecha = $pedidos->getCellByColumnAndRow(4, $indiceFila);
	$producto = $pedidos->getCellByColumnAndRow(5, $indiceFila);
	$nombre_prod = $pedidos->getCellByColumnAndRow(5, $indiceFila);
	$cantidad = $pedidos->getCellByColumnAndRow(5, $indiceFila);
	$sentencia->execute([$cliente, $nombre, $doc, $fecha, $producto, $nombre_prod, $cantidad]);
}
