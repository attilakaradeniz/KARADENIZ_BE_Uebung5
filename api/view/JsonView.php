<?php

class JsonView
{
    public function __construct()
    {
        header('Content-Type: application/json');
    }

    public function output($data){
        $jsonOutput = json_encode($data);
        echo $jsonOutput;
    }
}