<?php
include 'GestionAutomovilesAuth.php';


$soapServer = new SoapServer(null, array('uri' => 'http://localhost/vehiculos/'));
$soapServer->setClass('GestionAutomovilesAuth');
$soapServer->handle();

