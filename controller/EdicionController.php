<?php

class EdicionController {
    private $edicionModel;
    private $render;

    public function __construct($edicionModel,$render){
        $this->edicionModel = $edicionModel;
        $this->render = $render;
    }
    public function procesarEdicion(){
        $id_publicacion = isset($_POST["id_publicacion"]) ? $_POST["id_publicacion"] : null;
        $id_secciones = isset($_POST["id_secciones"]) ? $_POST["id_secciones"] : null;
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
        $precio = isset($_POST["precio"]) ? $_POST["precio"] : null;

        $ultimo_id_edicion =  $this->edicionModel->insertarEdicion($id_publicacion, $nombre, $precio);
        
        $this->edicionModel->insertarSecciones($ultimo_id_edicion, $id_secciones);
    }
}