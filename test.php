<?php
require_once __DIR__ . '/vendor/autoload.php';

use Classes\CashIn\CashIn;

$c = new CashIn;
$res = $c->comission(5843);

echo $res . PHP_EOL;