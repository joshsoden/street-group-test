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
            $data = $this->removeWhiteSpaceFromArray($data);
            error_log(json_encode($data));
            $this->parseCsvRow($data);
            $array[] = $data;
        }

        fclose($open);
    }

    // Handle rows in case there are multiple people per row
    function parseCsvRow($row) {
        foreach($row as $person) {
            // parse person here
            $this->parseCsvPerson($person);
        }
    }

    // Parse 'person' data and convert to object
    function parseCsvPerson($person) {
        error_log("New person: " . $person);
    }

    function removeWhiteSpaceFromArray($array) {
        return array_filter($array);
    }
    
}