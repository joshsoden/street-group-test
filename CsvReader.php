<?php 

class CsvReader
{
    public string $fileName;

    function __construct($fileName) {
        $this->fileName = $fileName;
    }

    function readFile() {
        $open = fopen($this->fileName, "r");

        while (($data = fgetcsv($open, null, ",")) !== FALSE) {
            // Read data 
            error_log(json_encode($data));
            $array[] = $data;
        }
        fclose($open);
    }
    // get data from file 

    // read through data 

    // close connection
}