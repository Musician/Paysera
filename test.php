<?php
require_once __DIR__ . '/vendor/autoload.php';

use Classes\CashIn\CashIn;
//use Classes\CashOut\CashOut;
use Classes\Currency\Currency;
use Classes\CsvReader\CsvReader;
use Classes\Transaction\Transaction;

// Reading data from file
$csv_file = __DIR__ . "/data.csv";
$csv = new CsvReader($csv_file);


// Testing if CashIn Class works properly.
$c = new CashIn;
$res = $c->commision(2000.00);
echo $res . PHP_EOL;

// Testing if CashOut Class works properly.
$c2 = new Currency;
$res3 = $c2->conversion(1548, "JPY");
echo $res3  . PHP_EOL;

echo "-------------------------------" . PHP_EOL;

// Cycling the data and perform payouts.
$totalPerWeek = array();

foreach ($csv->getData() as $trn)
{
    // If we have had set our dates for at least two transactions, we calculate if we match the 1000 per WEEK rule. 
    if (!empty($totalPerWeek[$trn[1]]['firstTransaction']) && !empty($totalPerWeek[$trn[1]]['secondTransaction']))
    {
        $datetime1 = new \DateTime($totalPerWeek[$trn[1]]['firstTransaction']);
        $datetime2 = new \DateTime($totalPerWeek[$trn[1]]['secondTransaction']);
        $interval = $datetime1->diff($datetime2);
        $timeDiff = $interval->days;
    }
    
    $transaction = new Transaction($trn);
    if ($transaction->trn->operationType == "cash_out")
    {
        // If we didn`t set first Transaction date, we assume this is FIRST transaction
        if (empty($totalPerWeek[$trn[1]]['firstTransaction']))
        {
            $totalPerWeek[$trn[1]]['firstTransaction'] = $transaction->trn->date;
        }
        // Otherwise, we set the second and check if we have two dates, to check if transactions are in the week. 
        else
        {
            $totalPerWeek[$trn[1]]['secondTransaction'] = $transaction->trn->date;
        }
        
        if (!empty($transaction->trn->timeBetweenPreviousTransaction) && $transaction->trn->timeBetweenPreviousTransaction < 7 )
        {
            $transaction->trn->totalPerWeek = $totalPerWeek[$trn[1]]['amount'];
            $totalPerWeek[$trn[1]]['amount'] += $transaction->trn->currencyConverted;
        }
        
        $transaction->trn->timeBetweenPreviousTransaction = (!empty($timeDiff)) ? $timeDiff : '';
    }
    
    
    $res4 = $transaction->getCommision();
    echo $res4 . PHP_EOL;
}