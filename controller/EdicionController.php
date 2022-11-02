<?php

class EdicionController {
    private $edicionModel;
    private $publicacionModel;
    private $render;

    public function __construct($edicionModel,$publicacionModel,$render){
        $this->edicionModel = $edicionModel;
        $this->publicacionModel = $publicacionModel;
        $this->render = $render;
    }

    public function crearEdicion(){
        $publicaciones = $this->publicacionModel->getPublicaciones();
        $secciones = $this->publicacionModel->getSecciones();
        echo $this->render->render("view/edicion/crearEdicion.php", array("publicaciones" => $publicaciones, "secciones" => $secciones));
    }

    public function accionesEdicion(){
        $ediciones = $this->edicionModel->getEdicionesDePublicacion();
        echo $this->render->render("view/edicion/accionesEdicion.php", array("ediciones" => $ediciones));
    }
    
    public function procesarAccionEdicion(){
      $accion = $_POST["accion"];
      $id = $_POST["id"];
      $nombre_edicion = $_POST["nombre_edicion"];
      $precio = $_POST["precio"];
        
      if ($accion === "Eliminar"){
        $this->edicionModel->eliminarEdicion($id);
        header('Location: /edicion/accionesEdicion');
    } else if ($accion === "Editar")
        $this->edicionModel->editarEdicion($id, $nombre_edicion, $precio);
        header('Location: /edicion/accionesEdicion');

    }

    public function procesarEdicion(){
        $id_publicacion = isset($_POST["id_publicacion"]) ? $_POST["id_publicacion"] : null;
        $id_secciones = isset($_POST["id_secciones"]) ? $_POST["id_secciones"] : null;
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
        $precio = isset($_POST["precio"]) ? $_POST["precio"] : null;

        $ultimo_id_edicion =  $this->edicionModel->insertarEdicion($id_publicacion, $nombre, $precio);
        
        $this->edicionModel->insertarSecciones($ultimo_id_edicion, $id_secciones);

        header('Location: /user/admin');
        // a la vista de admin

    }
}