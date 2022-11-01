<?php

class EdicionController {
    private $edicionModel;
    private $render;

    public function __construct($edicionModel,$render){
        $this->edicionModel = $edicionModel;
        $this->render = $render;
    }
    public function procesarEdicion(){
        $id_publicacion = $_POST["id_publicacion"];
        $id_secciones = $_POST["id_secciones"];
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];

        echo $this->edicionModel->insertarEdicion($id_publicacion, $nombre, $precio);
    }

}