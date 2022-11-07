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

    public function crearArticulo(){
        $publicaciones = $this->publicacionModel->getPublicaciones();

        echo $this->render->render("view/articulo/crearArticulo.php", array("publicaciones" => $publicaciones));
    }

    
    public function procesarArticulo(){
        $id_edicion_seccion = isset($_POST["id_seccion"]) ? $_POST["id_seccion"] : NULL;
        $id_usuario_creador = 1; // ver de crear una variable en session con los datos mas importante del usuario que se logueó
        $id_estado = 1; // por defecto 1? 
        $lat = 500.00;
        $lon = 500.00;
        $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : NULL;
        $bajada = isset($_POST["bajada"])  ? $_POST["bajada"] : NULL;
        //$foto = procesar_imagen(isset($_POST["foto"]));
        $contenido = isset($_POST["contenido"]) ? $_POST["contenido"] : NULL; // ver si se hace un json_encode ?? 

        echo "id edicion ->$id_edicion_seccion";
        echo "<br>";
        echo "titulo  -> $titulo";
        echo "<br>";
        echo "bajada  -> $bajada";
        echo "<br>";
        echo "contenido  -> $contenido";

    }

    public function procesarImagen(){
        reset ($_FILES); 
        $temp = current($_FILES); 
        $carpeta_destino =  "public/img/articulos/";
        $filetowrite = $carpeta_destino . $temp['name']; 

        if (is_uploaded_file($temp['tmp_name'])){
            if(move_uploaded_file($temp["tmp_name"], $filetowrite)){
                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https://" : "http://"; 
                $baseurl = $protocol . $_SERVER["HTTP_HOST"] . rtrim(dirname($_SERVER['REQUEST_URI']), "/") . "/"; 
                echo json_encode(array('location' => $baseurl . $filetowrite));
            }else{ 
                echo json_encode(array('location' => $filetowrite));

            } 
        }
        
    }
}