<?php 

class PersonObject
{
    public string $title;
    public string $first_name;
    public string $initial;
    public string $last_name;

    function __construct($title, $first_name = null, $initial = null, $last_name) {
        $this->title = $title;
        $this->first_name = $first_name;
        $this->initial = $initial;
        $this->last_name = $last_name;
    }
}