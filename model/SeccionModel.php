<?php

class SeccionModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getSecciones(){
        return $this->database->query("SELECT * FROM seccion");
    }

    public function obtenerSeccionesDeUltimaEdicionSegunPublicacion($id_publicacion){
        $sql = "SELECT s.id, s.nombre FROM seccion s
                    JOIN edicion_seccion ed ON ed.id_seccion = s.id  
                    WHERE ed.id_edicion = 
                        (SELECT e1.id FROM edicion e1  
                            WHERE e1.fecha_creacion = (
                                SELECT MAX(e2.fecha_creacion) FROM edicion e2 
                                WHERE id_publicacion = $id_publicacion)
                        )";

        return $this->database->query($sql);
    }

}