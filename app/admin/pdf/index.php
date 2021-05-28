<?php

require_once "dompdf/autoload.inc.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$html = file_get_contents("http://conta.bistrita-webdesign.ro/pdf/test.php?ID=12");

$dompdf -> loadHtml($html);

$dompdf -> setPaper('A4' , 'portrait');

$dompdf -> render();


$dompdf -> stream("codesworld", array("Attachment" => 0));

$output = $dompdf->output();

file_put_contents('Brochure.pdf', $output);

?>