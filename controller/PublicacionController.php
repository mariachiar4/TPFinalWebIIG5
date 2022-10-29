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
        // teniendo en cuenta que en la url (get) nos trae la-nacion (minuscula y con - en vez de espacio) -> formatearlo para poder buscar en db
        $nombre_publicacion = ucwords(str_replace("-", " ", $_GET["p"]));

        $publicacion = $this->publicacionModel->getPublicacion($nombre_publicacion);

        echo $this->render->render("view/publicacion.php",array("publicacion" => $publicacion));

    }
}