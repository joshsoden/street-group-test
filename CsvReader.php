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
            $data = $this->removeWhiteSpaceFromArray($data);
            error_log(json_encode($data));
            $array[] = $data;
        }

        fclose($open);
    }

    function removeWhiteSpaceFromArray($array) {
        return array_filter($array);
    }
}