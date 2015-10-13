<?php

// load config
require_once('../config/config.php');

// load memstats class
require_once('../models/memstats.class.php');

// create new memstats object
$memstats = new memstats();

// to check if new files have been added, rather than checking all the files in the database
// each time the job is run, instead we'll just check the most recently inserted file, as that
// is much faster than repeatedly checking every file in the directory against the database

// this grabs the last modified file
$lastfile = shell_exec('ls -t ' . SCRIPTPATH . 'logfiles/'.' | head -n1');

// check the database to see if we've already inserted this file
// since we know the format of this file, we don't actually have to store the file name in
// the database,which saves some space.
$epoch = $memstats->getTimeStampFromFileName($lastfile);

// if this file isn't present in the database, we'll grab a list of the files in the directory
// it's possible that more than one has been added since this job was last run

$result = $memstats->searchRecord($epoch);

if ($result['total'] >= 1){

    // we have a match, do nothing (maybe create a log?)

}else {
    // list the files
    $filelist = shell_exec('ls -b ../logfiles/');

    // if there are files in directory, put them in an array
    if ($filelist) {
        $filelistary = explode(chr(10), $filelist);
        $memstats->checkBatch($filelistary);
    }
}