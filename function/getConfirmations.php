<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$chaincoin = new ChainCoin();

$info = $chaincoin->callMethod('getrawtransaction', array(0 => $_GET['txid'], 1 => true));

if ($chaincoin->getError() == NULL)
  echo ($info['confirmations']);
else
  echo $chaincoin->getError();
