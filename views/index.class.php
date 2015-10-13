<?php

class index {

    private $templatename;
    public $title;
    public $heading;
    public $body;

    function __construct($templatename){

        $this->templatename = $templatename;

    }

    function showPage(){

        $filename = '/templates/' . $this->templatename . "/default.php";
        $pagedata = file_get_contents(SCRIPTPATH . $filename);

        $pagedata = str_replace("[HEADING]", $this->heading, $pagedata);
        $pagedata = str_replace("[TITLE]", $this->title, $pagedata);
        $pagedata = str_replace("[BODY]", $this->body, $pagedata);
        $pagedata = str_replace("[TEMPLATE]", $this->templatename, $pagedata);

        echo $pagedata;

    }

}