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
    private $notificacion;

    public function __construct($articuloModel, $seccionModel, $publicacionModel, $render){
        $this->articuloModel = $articuloModel;
        $this->seccionModel = $seccionModel;
        $this->publicacionModel = $publicacionModel;
        $this->render = $render;
        $this->notificacion = "";
    }

    public function crearArticulo(){
        $publicaciones = $this->publicacionModel->getPublicaciones();

        echo $this->render->render("view/articulo/crearArticulo.php", array("publicaciones" => $publicaciones, "notificacion" => $this->notificacion));
    }

    public function procesarArticulo(){
        $id_edicion_seccion = isset($_POST["id_seccion"]) ? $_POST["id_seccion"] : NULL;
        $id_usuario_creador = 1; // ver de crear una variable en session con los datos mas importante del usuario que se logueó
        $id_estado = 1; // por defecto 1? 
        $lat = 500.00;
        $lon = 500.00;
        $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : NULL;
        $bajada = isset($_POST["bajada"]) ? $_POST["bajada"] : NULL;
        $id_articulo = $this->articuloModel->getLastPublicacion()[0]["id"];
        $foto = isset($_FILES["imagen"]) ? $this->procesar_imagen($id_articulo, $_FILES["imagen"]) : NULL;
        $contenido = isset($_POST["contenido"]) ? $_POST["contenido"] : NULL;
        if($id_edicion_seccion != null && $titulo != null && $bajada != null && $foto != null && $contenido != null){
            $response = $this->articuloModel->crearArticulo($id_edicion_seccion, $id_usuario_creador, $id_estado, $lat, $lon, $titulo, $bajada, $foto, $contenido);
            $this->notificacion = $response == 1 ? "El artículo se creó correctamente" : "El artículo no se pudo crear"; // ver como redirigir y mandar msj correctamente
            if($response == 1){
                header('Location: /user/panelAdmin');
                exit;
            }else{
                if($foto != null){
                    unlink($_SERVER["DOCUMENT_ROOT"] . "/public/img/articulos/". $foto);
                }
                $this->crearArticulo();
            }

        }else{
            //no se pudo crear articulo
            if($foto != null){
                unlink($_SERVER["DOCUMENT_ROOT"] . "/public/img/articulos/". $foto);
            }
            $this->notificacion = "Error al crear el artículo, complete los campos";
            $this->crearArticulo();
        }
    }

    public function procesar_imagen($id_articulo, $img){
        $type = explode("/", $img["type"])[1];
        $nombre = "img-articulo-$id_articulo.$type";
        
        $carpeta_destino = $_SERVER["DOCUMENT_ROOT"] . "/public/img/articulos/";
        move_uploaded_file($img["tmp_name"],$carpeta_destino . $nombre);
        return $nombre;
    }
}