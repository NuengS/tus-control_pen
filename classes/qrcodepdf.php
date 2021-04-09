<?php
include_once './vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [70, 70]]);
$html = '<barcode code="' .  $_GET["id"] . '" type="QR" class="baracode" size="1.5" error="M" disablebborder="1"/>';
try {
    $mpdf->WriteHTML($html);
} catch (Mpdf\MpdfException $e) {
    die($e->getMessage());
}
$mpdf->Output();
