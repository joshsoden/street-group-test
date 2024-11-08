<?php 

require("./PersonObject.php");

class PersonObjectConstructor 
{
    // For checking against strings
    public array $titles = ["Mr", "Mrs", "Ms", "Mister", "Miss", "Dr", "Prof"];
    public array $joins  = ["&", "and"];

    function __construct() {}

    function createPersonObject($person) {
        if ($this->isNameValid($person)) {

        } else { 
            return null;
        }
    }

    // Check if name is valid
    function isNameValid($name) {
        // Check for required fields
        $name_array = explode(" ", $name);
        if (count($name_array) < 2 || !$this->hasTitle($name_array)) {
            error_log($name . " is not a valid name. ");
            return false;
        }


        error_log($name . " is a valid name!");

        $fields = $this->getFieldsFromNameArray($name_array);

        return true;
    }

    // Check whether the array has a title; required field 
    function hasTitle($name_array) {
        return $this->arrayContainsConfigValues($name_array, $this->titles);
    }

    // Check whether array contains "&" or "and"
    function hasMultipleNames($name_array) {
        return $this->arrayContainsConfigValues($name_array, $this->joins);
    }

    function arrayContainsConfigValues($array, $config) {
        return !empty(array_intersect($array, $config));
    }


    function getFieldsFromNameArray($name_array) {
        if ($this->hasMultipleNames($name_array)) {
            // Process with multiple
            error_log("Multiple names - processing as multiple");
        } else {
            // Process single name
            error_log("Single name - processing as one name only");
        }
    }
}