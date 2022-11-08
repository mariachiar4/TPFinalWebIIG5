<?php

class ArticuloModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }


    public function getArticulos(){
        return $this->database->query("SELECT * FROM articulo");
    }

    public function obtenerArticulosSegunPublicacion($id_publicacion){
        return $this->database->query("SELECT a.id, a.titulo, a.bajada FROM articulo a
                                            JOIN edicion_seccion ed ON ed.id = a.id_edicionSeccion  
                                            WHERE ed.id_edicion = 
                                                (SELECT e1.id FROM edicion e1  
                                                    WHERE e1.fecha_creacion = (
                                                        SELECT MAX(e2.fecha_creacion) FROM edicion e2 
                                                        WHERE id_publicacion = $id_publicacion)
                                                )");
    }

}