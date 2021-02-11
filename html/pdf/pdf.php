<?php
require_once('../vendor/dompdf_1-0-2/dompdf/autoload.inc.php');
//require_once('../html/vendor/dompdf_0-8-0/dompdf/autoload.inc.php');

use Dompdf\Dompdf;

ob_start();
require_once(dirname('__FILE__').'/formato.php');
$html = ob_get_clean();
//$html = file_get_contents("formato.php");
$dompdf = new Dompdf();
//$dompdf->setPaper("A4", "landscape");
$dompdf->loadHtml($html);
$dompdf->render();

//$pdf = $dompdf->output();
$filename = "batch_record";
$ref = "20003";
//file_put_contents($filename, $pdf);
//$dompdf->stream('Batch Record');
$dompdf->stream($filename.' '.$ref, array("Attachment" => 0));

