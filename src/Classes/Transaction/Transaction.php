<?php 

namespace Classes\Transaction;

use Classes\CashIn\CashIn;
use Classes\CashOut\CashOut;
use Classes\Currency\Currency;


/**
 *  Class Transaction
 *  This actually is the file, where the task is made. It uses other classes to get the proper payout.  
 * 
 */

class Transaction
{
    /**
     *  Simply prepare the data for the transaction
     */
    
    public $totalPerWeek;
    
    public function __construct($trn)
    {
        $currency = new Currency; // Little dependancy injection
        @$this->trn->date            = $trn[0];
        $this->trn->userId           = $trn[1];
        $this->trn->userType         = $trn[2];
        $this->trn->operationType    = $trn[3];
        $this->trn->amount           = $trn[4];
        $this->trn->currency         = $trn[5];
        $this->trn->currencyConverted  = $currency->conversion($this->trn->amount, $this->trn->currency);
    }
    
    public function getCommision()
    {
        
        switch ($this->trn->operationType)
        {
            // Cash In Rules
            case "cash_in":
                $c = new CashIn;
                return $c->commision($this->trn->currencyConverted);
            break;
            
            // Cash Out Rules
            case "cash_out":
                $c = new CashOut;
                
                // Legal Persons Rule
                // Commission fee - 0.3% from amount, but not less than 0.50 EUR for operation.
                if ($this->trn->userType == "legal")
                {
                    return $c->commision($this->trn->currencyConverted);
                }
                // Natural Persons Rules
                else
                {
                    /** Natural Persons
                     *   Default commission fee - 0.3% from cash out amount.
                     *
                     *  1000.00 EUR per week (from monday to sunday) is free of charge.
                     *
                     *  If total cash out amount is exceeded - commission is calculated only from exceeded amount (that is, for 1000.00 EUR there is still no commission fee).
                     *
                     *  This discount is applied only for first 3 cash out operations per week for each user - for forth and other operations commission is calculated by 
                     *  default rules (0.3%) - rule about 1000 EUR is applied only for first three cash out operations.
                    */                    
                    if (!empty($this->trn->totalPerWeek))
                    {
                        if ($this->trn->totalPerWeek + $this->trn->currencyConverted < 1000)
                        {
                            return 0;
                        } 
                        else
                        {
                            return $c->commision($this->trn->currencyConverted - 1000);
                            
                            
                        }
                    }
                        
                    return $c->commision($this->trn->currencyConverted);
                    
                    
                }

            break;
        }
    }
    
}

