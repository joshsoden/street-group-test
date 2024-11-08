<?php 

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

        // Name is valid; process into object
        $person_object = new Person();

        error_log($name . " is a valid name!");
        return true;
    }

    // Check whether the array has a title; required field 
    function hasTitle($name_array) {
        return !empty(array_intersect($name_array, $this->titles));
    }
}