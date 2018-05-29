<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$chaincoin = new ChainCoin();

$info = $chaincoin->callMethod('gettransaction', array(0 => $_GET['txid']));

if ($chaincoin->getError() == NULL)
  echo ($info['confirmations']);
else
  echo $chaincoin->getError();
