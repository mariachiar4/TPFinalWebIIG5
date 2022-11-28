<?php

class PublicacionModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    

    public function getPublicaciones(){
        $id_usuario = isset($_SESSION["usuario"]) ? $_SESSION["usuario"][0]["id"] : null;

        return $this->database->query("SELECT p.*, IF(p.id = s.id_publicacion AND s.id_usuario = $id_usuario, true ,false) as estaSuscripto, s.fecha_fin
                                    FROM publicacion p 
                                    LEFT JOIN suscripcion s on p.id = s.id_publicacion
                                    GROUP BY p.id");
    }

    public function getPublicacion($id){
        return $this->database->query("SELECT * FROM publicacion WHERE id = '$id'");
    }
 
    
    public function cambiarEstadoPublicacion($id){
        return $this->database->execute("UPDATE publicacion SET estado = IF(estado=1, 0, 1) WHERE id = $id");
    }
}