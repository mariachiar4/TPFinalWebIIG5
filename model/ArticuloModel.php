<?php

class ArticuloModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

   /*  public function crearArticulo($id_edicion_seccion, $id_usuario_creador, $id_estado, $lat, $lon, $titulo, $bajada, $foto, $contenido){ */
    public function crearArticulo($articulo){
        $titulo = $articulo["titulo"];
        $bajada = $articulo["bajada"];
        $contenido = $articulo["contenido"];
        $id_usuario_creador = $articulo["id_usuario_creador"];
        $id_estado = $articulo["id_estado"];
        $lat = $articulo["lat"];
        $lon = $articulo["lon"];
        $fotos = $articulo["fotos"];
        $id_edicionSeccion = $articulo["id_edicionSeccion"];
        
    
        return $this->database->execute("INSERT INTO articulo (id_estado, id_edicionSeccion, id_usuarioCreador,lat ,lon ,titulo ,bajada ,fotos ,contenido) 
                                        VALUES ($id_estado,$id_edicionSeccion, $id_usuario_creador, $lat, $lon, '$titulo', '$bajada', '$fotos', '$contenido');");
    }
    public function getLastPublicacion(){
        return $this->database->query("SELECT * FROM articulo WHERE id = (SELECT MAX(id) FROM articulo)");

    }

    public function getArticulos(){
        return $this->database->query("SELECT a.id, a.titulo, u.nombre as usuarioCreador, e.nombre as edicion, s.nombre as seccion, p.nombre as publicacion
                                FROM articulo a 
                                LEFT JOIN usuario u on  u.id = a.id_usuarioCreador
                                LEFT JOIN edicion_seccion ed on  a.id_edicionSeccion = ed.id 
                                LEFT JOIN seccion s on s.id = ed.id_seccion
                                LEFT JOIN edicion e on e.id = ed.id_edicion
                                LEFT JOIN publicacion p on p.id = e.id_publicacion
                                ");
    }

    public function getArticulo($id){
        return $this->database->query("SELECT a.id as id_articulo, p.id as id_publicacion, u.nombre as usuarioCreador, ed.id_seccion, s.nombre as seccion, a.titulo, a.bajada, a.fotos, a.contenido, a.lat, a.lon 
                                FROM articulo a 
                                LEFT JOIN usuario u on  u.id = a.id_usuarioCreador
                                LEFT JOIN edicion_seccion ed on  a.id_edicionSeccion = ed.id 
                                LEFT JOIN seccion s on s.id = ed.id_seccion
                                LEFT JOIN edicion e on e.id = ed.id_edicion
                                LEFT JOIN publicacion p on p.id = e.id_publicacion
                                WHERE a.id = $id");
    }

    public function obtenerArticulosSegunPublicacion($id_publicacion){
        return $this->database->query("SELECT a.id, a.titulo, a.bajada, a.fotos 
                                FROM articulo a
                                LEFT JOIN edicion_seccion ed ON ed.id = a.id_edicionSeccion
                                LEFT JOIN edicion e ON e.id = ed.id_edicion
                                WHERE e.id_publicacion = $id_publicacion
                                -- AND id_estado = 3
                                ");
    }
}