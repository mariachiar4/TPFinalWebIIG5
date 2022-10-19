<?php

class UserController {
    private $userModel;
    private $render;

    public function __construct($userModel,$render){
        $this->userModel = $userModel;
        $this->render = $render;
    }


    public function execute(){
        echo $this->render->render("view/register.php");
    }

    public function registrarse(){
        $data["nombre"] = $_POST["nombre"];
        $data["email"]  = $_POST["email"];
        $data["password"]  = $_POST["password"];

        $resultadoRegistro = $this->userModel->insertarUsuario($data);

        if ($resultadoRegistro === "registrado"){
            //mandarmail
            echo $this->render->render("view/registradoOk.php", array("nombre" => $data["nombre"]) );
        } else {
            echo $this->render->render("view/registradoError.php", array("error" => $resultadoRegistro) );
        }
    }

    public function getLogin(){
        echo $this->render->render("view/login.php" );
    }
    
    public function login(){ 
        $data["email"]  = $_POST["email"];
        $data["password"]  = $_POST["password"];

        $resultado = $this->userModel->getUsuario($data);

        if ($resultado) {
            $_SESSION["logueado"] = true;
            echo $this->render->render("view/home.php");

        } else {
            echo $this->render->render("view/login.php");
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