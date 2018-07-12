<?php

require_once __DIR__ . '/vendor/autoload.php';
$csv_file = __DIR__ . "/data.csv";

use Classes\CsvReader\CsvReader;
use Classes\Transaction\Transaction;

echo "-------------------------------" . PHP_EOL;
$csv = new CsvReader($csv_file);

foreach ($csv->getData() as $trn)
{
    $transaction = new Transaction($trn);
    $res4 = $transaction->getCommision();
    if (!empty($res4))
        echo $res4 . PHP_EOL;
    #print_r($transaction);
}