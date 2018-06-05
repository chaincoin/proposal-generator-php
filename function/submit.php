<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$chaincoin = new ChainCoin();

$command = explode(" ", $_POST['proposal']);

$info = $chaincoin->callMethod($command[0],
  array(
    0 => $command[1],
    1 => $command[2],
    2 => $command[3],
    3 => $command[4],
    4 => $command[5],
    5 => $command[6]
  ));

if ($chaincoin->getError() == NULL)
  echo "!" . $info;
else {
  echo "?" . $chaincoin->getError();
}
