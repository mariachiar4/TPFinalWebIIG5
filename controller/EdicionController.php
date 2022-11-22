<?php

class EdicionController {
    private $edicionModel;
    private $publicacionModel;
    private $seccionModel;
    private $render;

    public function __construct($edicionModel, $publicacionModel, $seccionModel,$render){
        $this->edicionModel = $edicionModel;
        $this->publicacionModel = $publicacionModel;
        $this->seccionModel = $seccionModel;
        $this->render = $render;
    }

    public function crearEdicion(){
        $publicaciones = $this->publicacionModel->getPublicaciones();
        $secciones = $this->seccionModel->getSecciones();
        echo $this->render->render("view/edicion/crearEdicion.php", array("publicaciones" => $publicaciones, "secciones" => $secciones));
    }

    public function accionesEdicion($notificacion = null){
        $ediciones = $this->edicionModel->getEdicionesDePublicacion();
        echo $this->render->render("view/edicion/accionesEdicion.php", array("ediciones" => $ediciones, "notificacion" => $notificacion));
    }
    
    public function procesarAccionEdicion(){
      $accion = $_POST["accion"];
      $id = $_POST["id"];
      $nombre_edicion = $_POST["nombre_edicion"];
      $precio = $_POST["precio"];
        
      if ($accion === "Eliminar"){
        $response = $this->edicionModel->eliminarEdicion($id);
        $this->accionesEdicion($response === 1 ? "Eliminado Correcto de id: $id" : "No se ha podido eliminar");
        exit;
    
    } else if ($accion === "Editar")
        $response = $this->edicionModel->editarEdicion($id, $nombre_edicion, $precio);
        $this->accionesEdicion($response === 1 ? "Editado Correcto de id: $id" : "No se ha podido editar");
        exit;
    }

    public function procesarEdicion(){
        $id_publicacion = isset($_POST["id_publicacion"]) ? $_POST["id_publicacion"] : null;
        $id_secciones = isset($_POST["id_secciones"]) ? $_POST["id_secciones"] : null;
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
        $precio = isset($_POST["precio"]) ? $_POST["precio"] : null;

        $ultimo_id_edicion =  $this->edicionModel->insertarEdicion($id_publicacion, $nombre, $precio);
        
        $this->edicionModel->insertarSecciones($ultimo_id_edicion, $id_secciones);


        $this->accionesEdicion("Edicion Creada");
        exit;
    }
}