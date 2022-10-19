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
        $this->mustache->setHelpers([
			'logueado' => $isLogged
		]);
        
        $contentAsString =  file_get_contents($contentFile);
        return  $this->mustache->render($contentAsString, $data);
    }
}