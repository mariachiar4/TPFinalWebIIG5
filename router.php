<?php

class Router{
    private $configuration;

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    private function validarPermisos($controller, $metodo, $rol_usuario){
        // 1 = contenidista / 2 = admin / 3 = lector
        $permisos = array(
            "user"=>array(
                "registrarse" => array("roles"=> array(), "requiereLogin" => false),
                "registrarContenidista" => array("roles"=> array(2), "requiereLogin" => true),
                "procesarRegistroContenidista" => array("roles"=> array(2), "requiereLogin" => true),
                "procesarRegistro" => array("roles"=> array(), "requiereLogin" => false),
                "accionesUsuarios" => array("roles"=> array(2), "requiereLogin" => true),
                "procesarAccionUsuario" => array("roles"=> array(2), "requiereLogin" => true),
                "verificarUsuario" => array("roles"=> array(), "requiereLogin" => false),
                "login" => array("roles"=> array(), "requiereLogin" => false),
                "procesarLogin" => array("roles"=> array(), "requiereLogin" => false),
                "logout" => array("roles"=> array(), "requiereLogin" => false),
                "panelAdmin" => array("roles"=> array(1,2), "requiereLogin" => true),
                "pdfContenidistas" => array("roles"=> array(2), "requiereLogin" => true),
                "pdfLectores" => array("roles"=> array(2), "requiereLogin" => true)
            ),
            "publicacion" => array(
                "execute" => array("roles"=> array(1,2,3), "requiereLogin" => true),
                "getPublicacion" => array("roles"=> array(1,2,3), "requiereLogin" => true),
                "accionesPublicacion" => array("roles"=> array(2), "requiereLogin" => true),
                "procesarAccionPublicacion" => array("roles"=> array(2), "requiereLogin" => true)
            ),
            "edicion" => array(
                "crearEdicion" => array("roles"=> array(2), "requiereLogin" => true),
                "accionesEdicion" => array("roles"=> array(2), "requiereLogin" => true),
                "procesarAccionEdicion" => array("roles"=> array(2), "requiereLogin" => true),
                "procesarEdicion" => array("roles"=> array(2), "requiereLogin" => true)
            ), 
            "seccion" => array(
                "procesarSeccionesSegunPublicacion" => array("roles"=> array(1,2), "requiereLogin" => true)
            ),
            "articulo" => array(
                "getArticulo" => array("roles"=> array(1,2,3), "requiereLogin" => true),
                "accionesArticulo" => array("roles"=> array(1,2), "requiereLogin" => true),
                "procesarArticulo" => array("roles"=> array(1,2), "requiereLogin" => true),
                "listar_articulos" => array("roles"=> array(1,2), "requiereLogin" => true),
                "editarArticulo" => array("roles"=> array(1,2), "requiereLogin" => true),
                "pdfArticulo" => array("roles"=> array(1,2,3), "requiereLogin" => true),
            )
        );
            
        $requireLogin = $permisos[!empty($controller) ? $controller : "publicacion" ][$metodo]["requiereLogin"];
        
        if ($requireLogin){ //si el metodo requiere estar logueado => se controla que su rol tenga permitido el acceso
            $rolesPermitidos = $permisos[!empty($controller) ? $controller : "publicacion" ][$metodo]["roles"];
            $tieneAcceso = false;
            foreach ($rolesPermitidos as $value) {
                if ($rol_usuario == $value){
                    $tieneAcceso = true;
                    break;
                }
            }
            return $tieneAcceso;
        } else { // si el metodo no requiere estar logueado => se deja continuar la navegacion
            return true;
        }
    }


    public function executeActionFromModule($action, $module){
        $isLogueado = isset($_SESSION["logueado"]) ? true : false;
        $rol_usuario = isset($_SESSION["usuario"])? $_SESSION["usuario"][0]["id_rol"] : null;

        $validacionExitosa = $this->validarPermisos($module, $action, $rol_usuario);

        if ($validacionExitosa){ // validacion exitosa => se le permite al usuario navegar
            $controller = $this->getControllerFrom($module);
            $this->executeMethodFromController($controller,$action);
        } else {
            if(!$isLogueado){ // si la validacion no fue exitosa y el usuario no esta logueado => se redirige a login
                $controller = $this->getControllerFrom("user");
                $this->executeMethodFromController($controller,"login");
            } else { // si la validacion no fue exitosa y el usuario esta logueado => se redirigue a pantalla principal
                $controller = $this->getControllerFrom("publicacion");
                $this->executeMethodFromController($controller,"execute");
            }
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