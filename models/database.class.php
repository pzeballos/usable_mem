<?php

class Database {

    // gathered from config
    private $dbhost = DB_HOST;
    private $dbuser = DB_USER;
    private $dbpass = DB_PASS;
    private $dbname = DB_NAME;

    // handler
    private $dbh;

    // storage for errors
    protected $error;

    // our statement
    private $stmt;

    // db options
    private $dboptions = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    // constructor
    function __construct(){
        // create db connection
        $this->createDBConnection();
    }

    // create a db connection
    protected function createDBConnection(){

    // establish DSN
    $dsn = 'mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname;

        try {
            $this->dbh = new PDO($dsn, $this->dbuser, $this->dbpass, $this->dboptions);
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    // function to prepare query
    protected function prepareQuery($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    // set up bindings
    protected function bind($param, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // execute query
    protected function execute(){
        return $this->stmt->execute();
    }

    // for single record transactions
    protected function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // for multiple records
    protected function fetchAll(){
        $this->execute();
        $results = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    // close the connection on destruct
    function __destruct(){
        $this->dbh = null;
    }

}
