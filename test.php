<?php
require_once __DIR__ . '/vendor/autoload.php';
// Used for money_format

use Classes\CashIn\CashIn;
use Classes\Currency\Currency;

$c = new CashIn;
$res = $c->commision(2000.00);
echo $res . PHP_EOL;

$c2 = new Currency();
$res3 = $c2->conversion(1548, "JPY");
echo $res3  . PHP_EOL;

