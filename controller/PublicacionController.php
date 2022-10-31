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
        $publicacion = $this->publicacionModel->getPublicacion($id);

        echo $this->render->render("view/publicacion.php",array("publicacion" => $publicacion));

    }
}