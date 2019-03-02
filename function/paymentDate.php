<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/settings.php';

$chaincoin = new ChainCoin();

$info = $chaincoin->callMethod('getblockchaininfo');

if ($chaincoin->getError() == NULL) {
  $blocks = $info['blocks'];
  $network = $info['chain'];

  $info = $chaincoin->callMethod('getfundinginfo');
  if ($chaincoin->getError() == "Method not found")
    $info = $chaincoin->callMethod('getgovernanceinfo');

  if ($chaincoin->getError() == NULL) {
    $nextSuper = $info['nextsuperblock'];
    $cycle = $info['superblockcycle'];

    $data = array();

    $max = ($network == "test") ? 100 : 26;

    for ($count = 0; $count < $max; $count++) {
      $value = (($nextSuper + ($cycle * $count)) - $blocks) * $blockTime;
      if ($network == "test")
        $miss = date("Y/m/d H:i", strtotime("+" . $value . " Seconds"));
      else
        $miss = date("Y/m/d", strtotime("+" . $value . " Seconds"));
      array_push($data, $miss);
    }

    echo json_encode($data);

  } else {
    echo "false";
  }
}
else
  echo "false";
