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

    function read_file() {
        $open = fopen($this->fileName, "r");

        while (($data = fgetcsv($open, null, ",")) !== FALSE) {
            // Read data 
            $data = $this->remove_whitespace_from_array($data);
            $this->parse_csv_row($data);
        }

        $this->constructor->log_people_array();

        fclose($open); 
    }

    // Handle rows in case there are multiple people per row
    function parse_csv_row($row) {
        foreach($row as $person) {
            // parse person here
            $this->parse_csv_person($person);
        }
    }

    // Parse 'person' data and convert to object
    function parse_csv_person($person) {
        return $this->constructor->create_person_object($person);
    }

    function remove_whitespace_from_array($array) {
        return array_filter($array);
    }
    
}