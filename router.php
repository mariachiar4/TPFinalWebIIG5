<?php

class Router{
    private $configuration;

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    private function validarPermisos(){

       $controllerBuscado = "user";
       $metodoBuscado = "procesarRegistro";


        $permisos = array(
            "user"=>array(
                "registrarse" => array("roles"=> array(1,2)),
                "procesarRegistro" => array("roles"=> array(1,2)),
                "procesarRegistro" => array("roles"=> array(1,2)),
                "procesarRegistro" => array("roles"=> array(1,2)),
                "procesarRegistro" => array("roles"=> array(1,2)),
                "procesarRegistro" => array("roles"=> array(1,2)),

            "publicacion" => array("getWeather","execute"))
        );

        $permisos[$controllerBuscado][$metodoBuscado];

        return $permisos[$controllerBuscado][$metodoBuscado];

    }


    public function executeActionFromModule($action, $module){
        $isLogueado = isset($_SESSION["logueado"]) ? true : false;

        if ($isLogueado){ // si esta logueado : dejar acceder a los checks de controllers y metodos
            $usuario = $_SESSION["usuario"];

            var_dump($this->validarPermisos());

            $controller = $this->getControllerFrom($module);
            $this->executeMethodFromController($controller,$action);
        } else if ($module === "user" && (
                        $action === "registrarse" ||
                        $action === "login" || 
                        $action === "verificarUsuario" || 
                        $action === "procesarLogin" 
                        || $action === "procesarRegistro"
                        )){ // si no es ta logueado, chequear que la navegacion sea restringida
            $controller = $this->getControllerFrom($module);
            $this->executeMethodFromController($controller,$action);
        } else { // si no esta dentro de la navegacion permitida, defaultear a user/login
            $controller = $this->getControllerFrom("user");
            $this->executeMethodFromController($controller,"login");
        }
    }

    private function getControllerFrom($module){
        $controllerName = "get" . ucfirst($module) . "Controller";
        $validController = method_exists($this->configuration, $controllerName) ? $controllerName : "getPublicacionController";
        return call_user_func(array($this->configuration, $validController));
    }

    private function executeMethodFromController($controller, $method){

        $validMethod = method_exists($controller, $method) ? $method : "execute";
        call_user_func(array($controller, $validMethod));
    }
}