<?php 
require("./CsvReader.php");

error_log("hello world");

$reader = new CsvReader("homeowners.csv");
$reader->read_file();