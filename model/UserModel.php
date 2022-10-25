<?php

class UserModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function insertarUsuario($data){
        $nombre = $data["nombre"];
        $email = $data["email"];
        $password = $data["password"];

        $usuarioEncontrado = $this->database->query("SELECT * FROM validacion WHERE email = '$email' ");
        
        if (count($usuarioEncontrado) === 0){
            $usuarioAgregado = $this->database->execute("INSERT INTO usuarios VALUES (null, '$nombre', null, null, '$email')") === 1 ? "registrado" : "error"; 
            if($usuarioAgregado > 0) $this->database->execute("INSERT INTO validacion VALUES ('$email', '$password', null, )") === 1 ? "registrado" : "error";
        } 
        return "usuarioExistente";
    }

    public function getUsuario($data){
        $email = $data["email"];
        $password = $data["password"];

        $usuarioEncontrado = $this->database->query("SELECT * FROM usuarios WHERE email = '$email' AND password = '$password' ");

        return count($usuarioEncontrado) !== 0 ? true : false;

    }


 /*    public function getUsers(){
        return $this->database->query("SELECT * FROM users");
    }

    public function getCancion($id){
        $sql = "SELECT * FROM canciones where idCancion = " . $id;
        return $this->database->query($sql);
    } */
}