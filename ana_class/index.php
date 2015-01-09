<?php 
include 'AnaWS.php';

$anaWS = new AnaWS();

$xml = $anaWS->getEstados();

header('Content-Type: application/json');

echo $xml;