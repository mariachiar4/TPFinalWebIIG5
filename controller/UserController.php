<?php

class UserController {
    private $userModel;
    private $render;

    public function __construct($userModel,$render){
        $this->userModel = $userModel;
        $this->render = $render;
    }


    public function execute(){
        echo $this->render->render("view/home.php");
    }

    public function registrarse(){
        echo $this->render->render("view/register.php" );
    }

    public function procesarRegistro(){
        $data["nombre"] = $_POST["nombre"];
        $data["email"]  = $_POST["email"];
        $data["password"]  = $_POST["password"];
        $data["lat"]  = 10.23;
        $data["lon"]  = 500.00;
        
        $errores_validacion = false;
        foreach($data as $clave => $valor){
            if($errores_validacion){
                break;
            }
            $errores_validacion = $this->validacion($clave, $valor);
        }

        $resultadoRegistro = $this->userModel->insertarUsuario($data);

        if ($resultadoRegistro === "registrado"){
            //mandarmail
            echo $this->render->render("view/registradoOk.php", array("nombre" => $data["nombre"]) );
        } else {
            echo $this->render->render("view/registradoError.php", array("error" => $resultadoRegistro) );
        }
    }

    private function validacion($clave, $valor){

        switch($clave){
            case "nombre": 
                $nombre_pattern = '/^[."a-zA-Z0-9- ]{4,50}$/';
                return preg_match($nombre_pattern, $valor) == 1 ? false : true;
            case "email": 
                $email_pattern = "/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/";
                return preg_match($email_pattern, $valor) == 1 ? false : true;
            case "password": 
                /*al menos un numero, al menos un caracter especial, al menos una letra, al menos 8 caracteres, maximo 16 caracteres*/
                $password_pattern = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&.,()"=_])[A-Za-z\d@$!%*#?&.,()"=_]{8,16}$/';
                return preg_match($password_pattern, $valor) == 1 ? false : true;
            case "lat": 
            case "lon":
                return !empty($valor) ? (is_double($valor) ? false : true) : true;                
        }
    }

    public function login(){
        echo $this->render->render("view/login.php" );
    }
    
    public function procesarLogin(){ 
        $data["email"]  = $_POST["email"];
        $data["password"]  = $_POST["password"];

        $resultado = $this->userModel->getUsuario($data);

        if ($resultado) {
            $_SESSION["logueado"] = true;
            echo $this->render->render("view/home.php");

        } else {
            $_SESSION = array();
            session_destroy();
            
            echo $this->render->render("view/login.php",array("error" => "Usuario o Contraseña Incorrecta"));
        }
    }

    public function logout(){ 
        $_SESSION = array();
        session_destroy();
        
        echo $this->render->render("view/login.php");

    }


  /*   public function execute(){
        $data["canciones"] = $this->songModel->getCanciones();
        echo $this->render->render("view/songView.php", $data);
    }

    public function description(){
        $id = $_GET["id"];
        $data["cancion"] = $this->songModel->getCancion($id);
        echo $this->render->render("view/songDescriptionView.php", $data);
    } */
}