<?php 

require("./PersonObjectConstructor.php");


class CsvReader
{
    public string $fileName;
    public PersonObjectConstructor $constructor;

    function __construct($fileName) {
        $this->fileName = $fileName;
        $this->constructor = new PersonObjectConstructor();
    }

    function readFile() {
        $open = fopen($this->fileName, "r");

        while (($data = fgetcsv($open, null, ",")) !== FALSE) {
            // Read data 
            $data = $this->removeWhiteSpaceFromArray($data);
            $this->parseCsvRow($data);
        }

        $this->constructor->log_people_array();

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
        return $this->constructor->createPersonObject($person);
    }

    function removeWhiteSpaceFromArray($array) {
        return array_filter($array);
    }
    
}