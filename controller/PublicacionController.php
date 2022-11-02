<?php

class PublicacionController {
    private $publicacionModel;
    private $render;

    public function __construct($publicacionModel,$render){
        $this->publicacionModel = $publicacionModel;
        $this->render = $render;
    }


    public function execute(){
        $publicaciones = $this->publicacionModel->getPublicaciones();

        echo $this->render->render("view/home.php",array("publicaciones" => $publicaciones));
    }

    public function getPublicacion(){
        $id = $_GET["id"];
        $secciones= $this->publicacionModel->getSecciones($id);

        echo $this->render->render("view/publicacion/publicacion.php",array("secciones" => $secciones));
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