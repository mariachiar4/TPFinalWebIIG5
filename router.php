<?php

class Router{
    private $configuration;

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    public function executeActionFromModule($action, $module){

        $isLogueado = isset($_SESSION["logueado"]) ? true : false;

        if ($isLogueado){ // si esta logueado : dejar acceder a los checks de controllers y metodos
            $controller = $this->getControllerFrom($module);
            $this->executeMethodFromController($controller,$action);
        } else if ($module === "user" && (
                        $action === "registrarse" ||
                        $action === "login" || 
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
          $validController = method_exists($this->configuration, $controllerName) ?$controllerName : "getUserController";
          return call_user_func(array($this->configuration, $validController));
    }

    private function executeMethodFromController($controller, $method){

        $validMethod = method_exists($controller, $method) ?$method : "execute";
        call_user_func(array($controller, $validMethod));
    }
}