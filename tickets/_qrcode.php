<?php

require 'vendor/autoload.php'; // charger l'autoloader de Composer

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

$content = urldecode(filter_input(INPUT_GET, 'content'));

$qr_code = QrCode::create($content);
$writer = new PngWriter();
$result = $writer->write($qr_code);

header("Content-Type: " . $result->getMimeType());
echo $result->getString();