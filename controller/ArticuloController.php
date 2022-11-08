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
    private $seccionModel;
    private $render;

    public function __construct($articuloModel, $seccionModel, $publicacionModel, $render){
        $this->articuloModel = $articuloModel;
        $this->seccionModel = $seccionModel;
        $this->publicacionModel = $publicacionModel;
        $this->render = $render;
    }

    public function getArticulo(){
        $id = $_GET["id"];
        $articulo = $this->articuloModel->getArticulo($id);


        echo $this->render->render("view/articulo/articulo.php", array("articulo" => $articulo));
    }

    public function crearArticulo(){
        $publicaciones = $this->publicacionModel->getPublicaciones();

        echo $this->render->render("view/articulo/crearArticulo.php", array("publicaciones" => $publicaciones));
    }

    public function procesarArticulo(){
        var_dump($_POST);
    }
    public function procesarArticulo_2(){
        $id_edicion_seccion = isset($_POST["id_seccion"]) ? $_POST["id_seccion"] : NULL;
        $id_usuario_creador = 1; // ver de crear una variable en session con los datos mas importante del usuario que se logueó
        $id_estado = 1; // por defecto 1? 
        $lat = 500.00;
        $lon = 500.00;
        $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : NULL;
        $bajada = isset($_POST["bajada"])  ? $_POST["bajada"] : NULL;
        $foto = procesar_imagen(isset($_POST["foto"]));
        $contenido = isset($_POST["contenido"]) ? $_POST["contenido"] : NULL; // ver si se hace un json_encode ?? 

        echo "id edicion ->$id_edicion_seccion";
        echo "<br>";
        echo "<br>";
        echo "bajada  -> $bajada";
        echo "<br>";
        echo "contenido  -> $contenido";

    }

    function subir_img($img){
        $nombre = $img["name"];
        $size = $img["size"];
        $type = $img["type"];
        
        $carpeta_destino = $_SERVER["DOCUMENT_ROOT"] . "/TPFinalWebIIG5/public/img/articulos/";
        move_uploaded_file($img["tmp_name"],$carpeta_destino . $nombre);
        return $nombre;
    }
}