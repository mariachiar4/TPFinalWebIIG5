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

    public function getArticulo($id){
        return $this->database->query("SELECT a.id, u.nombre as usuarioCreador, s.nombre as seccion, a.titulo, a.bajada, a.fotos, a.contenido, a.lat, a.lon 
                                FROM articulo a 
                                JOIN usuario u on  u.id = a.id_usuarioCreador
                                JOIN edicion_seccion ed on  a.id_edicionSeccion = ed.id 
                                JOIN seccion s on s.id = ed.id_seccion
                                WHERE a.id = $id");
    }

    public function obtenerArticulosSegunPublicacion($id_publicacion){
        return $this->database->query("SELECT a.id, a.titulo, a.bajada FROM articulo a
                                            JOIN edicion_seccion ed ON ed.id = a.id_edicionSeccion  
                                            WHERE ed.id_edicion = 
                                                (SELECT e1.id FROM edicion e1  
                                                    WHERE e1.fecha_creacion = (
                                                        SELECT MAX(e2.fecha_creacion) FROM edicion e2 
                                                        WHERE id_publicacion = $id_publicacion)
                                                )
                                            AND a.id_estado = 3");
    }

}