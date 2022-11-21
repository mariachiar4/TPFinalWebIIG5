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

    private function getWeather(){
        $curl = curl_init();
        $lat = $_SESSION["usuario"][0]["lat"];
        $lon = $_SESSION["usuario"][0]["lon"];

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&current_weather=true", //cookies de usuario -> lat / lon
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $response = json_decode($response,true);
        $current = isset($response["current_weather"]) ? $response["current_weather"] : null;
        return $current;
    }

    public function execute(){
        $publicaciones = $this->publicacionModel->getPublicaciones();
        
        $pronostico = $this->getWeather();

        echo $this->render->render("view/home.php",array("publicaciones" => $publicaciones, "pronostico" => $pronostico));
    }

    public function getPublicacion(){
        $id = $_GET["id"];
        $secciones = $this->seccionModel->obtenerSeccionesDeUltimaEdicionSegunPublicacion($id);
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