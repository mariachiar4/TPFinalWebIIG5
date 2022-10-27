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
        $password = !empty($password) ? md5($password) : null;
        $lat = $data["lat"];
        $lon = $data["lon"];
        $token = bin2hex(random_bytes(16)); 

        $usuarioEncontrado = $this->database->query("SELECT * FROM validacion WHERE email = '$email' ");
        
        if (count($usuarioEncontrado) === 0){
            $usuarioAgregado = $this->database->execute("INSERT INTO usuario VALUES (null, '$nombre', $lat, $lon, '$email')"); 
            if($usuarioAgregado > 0) return $this->database->execute("INSERT INTO validacion VALUES ('$email', '$password', '$token', 0)") === 1 ? "registrado" : "error";
        
        } 
        return "usuarioExistente";
    }

    public function getUsuario($data){
        $email = $data["email"];
        $password = $data["password"];

        $usuarioEncontrado = $this->database->query("SELECT * FROM usuario WHERE email = '$email' AND password = '$password' ");

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