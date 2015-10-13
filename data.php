<?php
// this file outputs a TSV file for a D3 chart

// load config
require_once('config/config.php');

// load memstats class
require_once('models/memstats.class.php');

// create new memstats object
$memstats = new memstats();

// get the last 30 records
$datary = $memstats->getLast30();

// echo out tab separated titles
echo "FreeMemory" . "\t" . "TimeStamp" . "\n";

// loop through data array
foreach ($datary as $row){
   echo $row['memfree'] . "\t" . substr($row['timestamp'], 5) . "\n";
}