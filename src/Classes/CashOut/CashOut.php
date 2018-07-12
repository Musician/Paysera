<?php

namespace Classes\CashOut;

/**
 * Class CashOut
 * Performs operation on Cash Out
 */

class CashOut
{

    /**
     *  Function commision:
     *  calculates given percentage for Cashed out amount. 
     */
    public function commision($amount, $percentage = 0.3, $limit = 0.50)
    {
        $fee = ($amount / 100) * $percentage;
        if ($fee < $limit)
        {
            return $limit;
        }
        else
        {
            return round($fee, 2);
        }
    }
    

    
}
