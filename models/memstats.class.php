<?php

class memstats extends database{

    public $memfree;
    public $timestamp;

    // get the timestamp from the filename
    public function getTimeStampFromFileName($filename){

        // extract epoch time from filename
        $fileary = explode ("-", $filename);

        // if we get 4 elements it's (probably) formatted properly
        if (count($fileary) == 4){

            // return a formatted time stamp
            return $timestamp = gmdate('Y-m-d H:i:s', (int) str_replace(".txt", "", $fileary[3]));

        }else {

            // return nothing
            return null;
        }
    }

    // extract free memory value from text file
    public function extractMemStatsFromFile($filename){

        try {
            // open the file
            $memfree = file_get_contents(SCRIPTPATH . '/logfiles/' . $filename);

            // return only integers (the kB amount)
            preg_match_all('!\d+!', $memfree, $matches);

            // if we have a match, send it
            if  ($matches[0][0]){
                return $matches[0][0];
            }else {
                return 0;
            }

        }catch (Exception $ex){
            $this->error = $ex;
        }
    }

    // search for an individual record
    public function searchRecord($timestamp){

        // create the query
        $this->prepareQuery('SELECT COUNT(*) total from `memusage`.`memstats` WHERE timestamp = :timestamp');

        // bind the values
        $this->bind(':timestamp', $timestamp);

        // execute
        return $this->single();
    }

    // save a record
    public function saveRecord(){

        // create the query
        $this->prepareQuery('INSERT INTO `memusage`.`memstats` (`id`, `memfree`, `timestamp`) VALUES (NULL, :memfree, :timestamp)');

        // bind the values
        $this->bind(':memfree', $this->memfree);
        $this->bind(':timestamp', $this->timestamp);

        // execute
        $this->execute();
    }

    // check a batch of filenames
    public function checkBatch($filelistary){

        // parse the file list array
        foreach ($filelistary as $filename){

            if (strlen($filename) > 1){

                // set the timestamp field from the filename
                $this->timestamp = $this->getTimeStampFromFileName($filename);

                // see if it exists in the database
                $searchresult = $this->searchRecord($this->timestamp);

                // if we have no record of it in db
                if ($searchresult['total'] == 0){

                    // insert it
                    $this->memfree = $this->extractMemStatsFromFile($filename);

                    if ($this->timestamp && $this->memfree){

                        // insert the record
                        $this->saveRecord();
                    }

                }
            }
        }
    }

    // get a list of records for display
    public function getLast30(){

        // create the query
        $this->prepareQuery('SELECT memfree, timestamp FROM `memstats`  ORDER by timestamp LIMIT 0,30');

        // execute and return as JSON
        //return json_encode($this->fetchAll());
        return $this->fetchAll();
    }
}