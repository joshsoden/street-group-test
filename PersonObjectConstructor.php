<?php 

class PersonObjectConstructor 
{
    // For checking against strings
    public array $titles = ["Mr", "Mrs", "Ms", "Mister", "Miss", "Dr"];
    public array $joins  = ["&", "and"];

    // For each person
    public string $person;

    function __construct($person) {
        $this->person = $person;
    } 
}