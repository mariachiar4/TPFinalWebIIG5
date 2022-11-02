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

    public function getPublicacion($id){
        return $this->database->query("SELECT * FROM publicacion WHERE id = '$id'");
    }

    public function getSecciones(){
        return $this->database->query("SELECT * FROM seccion");
    } 
    
    public function cambiarEstadoPublicacion($id){
        return $this->database->execute("UPDATE publicacion SET estado = IF(estado=1, 0, 1) WHERE id = $id");
    }
}