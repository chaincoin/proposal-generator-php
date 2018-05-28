<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$chaincoin = new ChainCoin();

$info = $chaincoin->callMethod('validateaddress', array(0 => $_GET['address']));

if ($chaincoin->getError() == NULL)
  echo $info['isvalid'] ? 'true' : 'false';
else
  echo $chaincoin->getError();
