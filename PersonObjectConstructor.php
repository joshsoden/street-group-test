<?php 

class PersonObjectConstructor 
{
    // For checking against strings
    public array $titles = ["Mr", "Mrs", "Ms", "Mister", "Miss", "Dr", "Prof"];
    public array $joins  = ["&", "and"];
    public array $people = [];

    function __construct() {}

    function createPersonObject($name) {
        $valid_name_array = $this->returnValidName($name);
        if ($valid_name_array) {
            $this->createPersonFromNameArray($valid_name_array);
        } else { 
            return null;
        }
    }

    // Check if name is valid
    function returnValidName($name) {
        // Check for required fields
        $name_array = explode(" ", $name);
        if (count($name_array) < 2 || !$this->hasTitle($name_array)) {
            return false;
        }
        return $name_array;
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

    function trim_name($name) {
        return trim($name, ".");
    }

    function createPersonFromNameArray($name_array) {
        if ($this->hasMultipleNames($name_array)) {
            // Process with multiple
            return $this->createPeopleFromMultipleNames($name_array);
        } else {
            // Process single name
            return $this->createPersonFromSingleName($name_array);
        }
    }

    function createPeopleFromMultipleNames($name_array) {
        // Split array to before & after join value 
        $join_index = key(array_intersect($name_array, $this->joins));
        $first_person = array_slice($name_array, 0, $join_index);
        $second_person = array_slice($name_array, $join_index + 1);

        // Copy over the last name, if not present in the first person
        if (count($first_person) == 1) {
            array_push($first_person, $second_person[count($second_person) - 1]);
        }

        // Create person 1 + 2 as separate objects
        $this->createPersonFromNameArray($first_person);
        $this->createPersonFromNameArray($second_person);
    }

    function createPersonFromSingleName($name_array) {
        // get length of array
        $array_length = count($name_array);
        $title = $name_array[0];
        $first_name = null;
        $initial = null; 
        $last_name = $name_array[$array_length - 1];

        if ($array_length > 2) {
            $first = $name_array[1];
            if (strlen($this->trim_name($first)) == 1) {
                $initial = $this->trim_name($first);
            } else {
                $first_name = $first;
            }
        }

        $person = $this->createPerson($title, $first_name, $initial, $last_name);
        array_push($this->people, $person);
    }

    function createPerson($title, $first_name = null, $initial = null, $last_name) {
        $person = [];
        $person["title"] = $title;
        $person["first_name"] = $first_name;
        $person["initial"] = $initial;
        $person["last_name"] = $last_name;

        return $person;
    }

    function log_people_array() {
        foreach ($this->people as $person) {
            $this->echoPersonValues($person);
        }
    }

    function echoPersonValues($person) {
        error_log("```");
        error_log("person[title] => " . $person['title']);
        error_log("person[first_name] => " . $person['first_name']);
        error_log("person[initial] => " . $person['initial']);
        error_log("person[last_name] => " . $person['last_name']);
        error_log("```");
    }
}