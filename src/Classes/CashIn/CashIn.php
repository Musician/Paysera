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
    public function comission($amount, $percentage = 0.03, $limit = 5)
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

}
