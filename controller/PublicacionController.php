<?php

class PublicacionController {
    private $publicacionModel;
    private $seccionModel;
    private $articuloModel;
    private $render;

    public function __construct($publicacionModel, $seccionModel, $articuloModel, $render){
        $this->publicacionModel = $publicacionModel;
        $this->seccionModel = $seccionModel;
        $this->articuloModel = $articuloModel;
        $this->render = $render;
    }


    public function execute(){
        $publicaciones = $this->publicacionModel->getPublicaciones();

        echo $this->render->render("view/home.php",array("publicaciones" => $publicaciones));
    }

    public function getPublicacion(){
        $id = $_GET["id"];
        $secciones = $this->seccionModel->obtenerSeccionesSegunPublicacion($id);
        $articulos = $this->articuloModel->obtenerArticulosSegunPublicacion($id);


        echo $this->render->render("view/publicacion/publicacion.php",array("id" => $id, "secciones" => $secciones, "articulos" => $articulos));
    }  
    
    public function accionesPublicacion($notificacion = null){
        $publicaciones = $this->publicacionModel->getPublicaciones();

        echo $this->render->render("view/publicacion/accionesPublicacion.php",array("publicaciones" => $publicaciones, "notificacion" => $notificacion));
    }  

    public function procesarAccionPublicacion(){
        $id = $_POST["id"];

        $response = $this->publicacionModel->cambiarEstadoPublicacion($id);

        $this->accionesPublicacion($response === 1 ? "Cambio de estado correcto de id: $id" : "No se ha podido cambiar estado");
          
    }
    

}