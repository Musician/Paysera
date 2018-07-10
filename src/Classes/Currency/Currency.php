<?php 

namespace Classes\Currency;

/**
 * Class Currency
 * Defines all currencies, rates and currency operations
 */

class Currency
{
    
    /**
     * Currency rates. This way is wrong, as currency rates are dynamic and should be loaded in different way. However, as they are statically given for the task, 
     * I defined them here for futher use. May be a call to DB to get current rates would be useful, but that will harden the task for now. 
     * 
     */
    const EUR = 1;
    const USD = 1.1497; // For 1 EUR
    const JPY = 129.53; // For 1 EUR
    
    public function conversion($amount, $to)
    {
        
        
        
    }
    
    
    
}


