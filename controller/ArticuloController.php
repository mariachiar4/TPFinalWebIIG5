<?php

// al crear un controller hay que crear:
/*
    model
    vista
    y agregar respectivas cosas en helpers/configuration
*/
class ArticuloController {
    private $articuloModel;
    private $publicacionModel;
    private $render;

    public function __construct($articuloModel, $publicacionModel, $render){
        $this->articuloModel = $articuloModel;
        $this->publicacionModel = $publicacionModel;
        $this->render = $render;
    }

    public function crearArticulo(){
        // necesitamos obtener las publicaciones
        $publicaciones = $this->publicacionModel->getPublicaciones();

        echo $this->render->render("view/articulo/crearArticulo.php", array("publicaciones" => $publicaciones));
    }

    public function obtenerSeccionesSegunPublicacion(){

        /* SQL que no anda para traer las secciones de la ultima edicion de la publicacion que elegimos para pasarla por ajax
        SELECT * FROM seccion 
        JOIN edicion_seccion ed ON ed.id_edicion = (SELECT e1.id FROM edicion e1  WHERE e1.fecha_creacion = (SELECT MAX(e2.fecha_creacion) FROM edicion e2 where id_publicacion = 1));
        */
    }

    public function procesarArticulo(){
        $id_edicion_seccion = isset($_POST["id_edicion_seccion"]);
        $id_usuario_creador = 1; // ver de crear una variable en session con los datos mas importante del usuario que se logueó
        $id_estado = 1; // por defecto 1? 
        $lat = 500.00;
        $lon = 500.00;
        $id_edicion_seccion = isset($_POST["titulo"]);
        $id_edicion_seccion = isset($_POST["bajada"]);
        $id_edicion_seccion = procesar_imagen(isset($_POST["foto"]));
        $id_edicion_seccion = isset($_POST["contenido"]); // ver si se hace un json_encode ?? 

        //function al model para guardar el articulo
    }

    public function procesar_imagen($img){
        //copy lo que esta en pokedex 
    }
}