<?php
require_once __DIR__ . '/vendor/autoload.php';

setlocale(LC_MONETARY,"bg_BG");


use Classes\CashIn\CashIn;

$c = new CashIn;
$res = $c->comission(2000.00);
$res2 = $c->comission_format(2000.00);

echo $res . PHP_EOL;
echo $res2 . PHP_EOL;