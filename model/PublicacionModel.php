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
    public function getPublicacion($publicacion){
        return $this->database->query("SELECT * FROM publicacion WHERE nombre = $publicacion
                              /* queria hacer un join a la tabla articulos y no puedo porque no tiene una union con el id ? tengo que acceder a la edicion, pero la edicion no se une con la publicacion */
                              ");
    }
}