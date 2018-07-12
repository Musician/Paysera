<?php 

namespace Classes\CsvReader;

/**
 * Class CsvReader
 * Used for file manipulation of comma separated data (CSV)
 */

class CsvReader
{

    /**
     * Initialize with CSV file
     */
    public function __construct($file)
    {
        if (!is_file($file))
        {
            throw new \Exception("File: " . $file . " is not found.");
        }
        else
        {
            $this->file = $file;
        }
    }

    /**
     * Used to extract data from given CSV file. 
     */
    public function getData() 
    {
        $res = array();
        $csv = array_map('str_getcsv', file($this->file));
        // This is used only if csv file has header describing the values below it. 
        //array_shift($csv);
        
        return $csv;
    }
    
}


