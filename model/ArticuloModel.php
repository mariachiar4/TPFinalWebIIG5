<?php

class ArticuloModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function crearArticulo($id_edicion_seccion, $id_usuario_creador, $id_estado, $lat, $lon, $titulo, $bajada, $foto, $contenido){
        return $this->database->execute("INSERT INTO articulo VALUES (null, $id_estado, $id_edicion_seccion, $id_usuario_creador, $lat, $lon, '$titulo', '$bajada', '$foto', '$contenido')");
    }
    public function getLastPublicacion(){
        return $this->database->query("SELECT * FROM articulo WHERE id = (SELECT MAX(id) FROM articulo)");

    }

}