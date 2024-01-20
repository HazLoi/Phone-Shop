<?php
// include 1D barcode class (search for installation path)
require_once(dirname(__FILE__).'/library/phpqrcode/qrlib.php');

$code = $_GET['code'];

// define('IMAGE_WIDTH',500);
// define('IMAGE_HEIGHT',500);

QRcode::png($code,false,QR_ECLEVEL_L,16,1);
// $code = $_GET['code'];
// // set the barcode content and type
// $barcodeobj = new TCPDFBarcode( $code, 'C128');
// // output the barcode as PNG image
// $barcodeobj->getBarcodePNG(1, 40, array(0,0,0));