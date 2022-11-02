<?php

class EdicionModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function insertarEdicion($id_publicacion, $nombre, $precio){
        $fecha_creacion = date("Y-m-d");
        return $this->database->execute_last_id("INSERT INTO edicion VALUES (null, $id_publicacion, '$nombre', '$fecha_creacion', $precio)");
        
    }

    public function insertarSecciones($id_edicion, $id_secciones){
        $error = false;
        foreach($id_secciones as $id_seccion){
            if($error){
                break;
            }
            $error = ($this->database->execute("INSERT INTO edicion_seccion VALUES (null, $id_edicion, $id_seccion)")) == 1 ? false : true;
        }
    }

    public function getEdicionesDePublicacion() {
        return $this->database->query("SELECT e.id, p.nombre as nombre_publicacion ,e.nombre as nombre_edicion, fecha_creacion, precio  FROM edicion e JOIN publicacion p ON e.id_publicacion = p.id;");
    } 

    public function getEdiciones(){
        return $this->database->query("SELECT * FROM edicion");
    }

    public function getEdicion($id){
        return $this->database->query("SELECT * FROM edicion WHERE id = '$id'");
    }

    public function eliminarEdicion($id){
        return  $this->database->execute("DELETE FROM edicion WHERE id = '$id'");
    }

    public function editarEdicion($id, $nombre_edicion, $precio){
        return  $this->database->execute("UPDATE edicion SET nombre = '$nombre_edicion', precio = $precio WHERE id = $id ");
    }
}