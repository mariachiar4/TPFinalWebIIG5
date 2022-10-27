<?php

class PublicacionModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getPublicaciones(){
        return $this->database->query("SELECT * FROM publicacion");

    }

}