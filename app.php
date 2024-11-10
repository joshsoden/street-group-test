<?php 
require("./CsvReader.php");

error_log("**** PHP Homeowner Parser ****");

$reader = new CsvReader("homeowners.csv");
$reader->read_file();