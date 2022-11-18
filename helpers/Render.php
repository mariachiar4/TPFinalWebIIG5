<?php

class Render{
    private $mustache;

    public function __construct($partialsPathLoader){
        Mustache_Autoloader::register();

        $this->mustache = new Mustache_Engine(
            array(
            'partials_loader' => new Mustache_Loader_FilesystemLoader( $partialsPathLoader )
        ));
    }

    public function render($contentFile , $data = array() ){
        // CHEQUEA EN CADA RENDERIZADO EL ESTADO DE LA SESION
        $isLogged = isset($_SESSION["logueado"])? true : false;
        $usuario = isset($_SESSION["usuario"]) ? $_SESSION["usuario"][0] : "";
        
        if($usuario != ""){
            if($usuario["id_rol"] == 1){
                $usuario["contenidista"] = true;
            }else if($usuario["id_rol"] == 2){
                $usuario["administrador"] = true;
            }else{
                $usuario["lector"] = true;
            }
        }
        var_dump($usuario);
        $this->mustache->setHelpers([
			"logueado" => $isLogged,
            "usuario" => $usuario
		]);
        $contentAsString =  file_get_contents($contentFile);
        return  $this->mustache->render($contentAsString, $data);
    }
}