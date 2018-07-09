<?php

namespace Classes\CashIn;

/**
 * Class CashIn
 * Performs operation on Cash In
 */

class CashIn
{

    /**
     *  Function comission:
     *  calculates given percentage for Cashed in amount. 
     * Usage:
     * $c = new CashIn;
     * $res = $c->comission(5843);
     * 
     * $res = 1.75
     */
    public function comission($amount, $percentage = 0.03, $limit = 5.00)
    {
        $fee = ($amount / 100) * $percentage;
        if ($fee > $limit)
        {
            return $limit;
        }
        else
        {
            return round($fee, 2);
        }
    }
    
    /**
     * Alias to method comission, but returns result in monetary formatting. If needed:
     * setlocale(LC_MONETARY,"en_US");
     * could be performed, to set the proper currency. 
     * Another possible usage could be setlocale outside and call "comission()" with money_format() of the returned result. 
     * I would use this second option with setlocale and money_format outside, but it is good idea to have it, just in case.
     */
    public function comission_format($amount, $percentage = 0.03, $limit = 5.00)
    {
        $fee = $this->comission($amount, $percentage, $limit);
        return money_format("%i", $fee);
    }
    
}
