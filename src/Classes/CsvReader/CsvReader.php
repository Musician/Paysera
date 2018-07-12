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
        $csv = array_map('str_getcsv', file($this->file));
        array_walk($csv, function(&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });
        array_shift($csv);
        
        return $csv;
    }
    
}


