<?php

class UserModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getInformacionDelUsuario($email){
        return $this->database->query("SELECT * FROM usuario WHERE email = '$email'");
    }

    public function insertarUsuario($data){
        $nombre = $data["nombre"];
        $email = $data["email"];
        $password = $data["password"];
        $id_rol = $data["id_rol"];
        $hash = !empty($password) ? md5($password) : null;
        $lat = $data["lat"];
        $lon = $data["lon"];
        $token = $data["token"];

        $usuarioEncontrado = $this->database->query("SELECT * FROM validacion WHERE email = '$email' ");
        
        if (count($usuarioEncontrado) === 0){
            $usuarioAgregado = $this->database->execute("INSERT INTO usuario VALUES (null, $id_rol, '$nombre', $lat, $lon, '$email')"); 
            if($usuarioAgregado > 0) return $this->database->execute("INSERT INTO validacion VALUES ('$email', '$hash', '$token', 0)") === 1 ? "registrado" : "error";
        
        } 
        return "usuarioExistente";
    }

    public function getUsuario($data){
        $email = $data["email"];
        $password = $data["password"];
        $hash = !empty($password) ? md5($password) : null;

        //comparamos el hash de la contraseña en bd con hash desde el request
        $usuarioEncontrado = $this->database->query("SELECT * FROM validacion WHERE email = '$email' AND contrasena = '$hash' ");

        return $usuarioEncontrado;
    }

    public function verificarUsuario($token){
        return $this->database->execute("UPDATE validacion SET confirmado = 1 WHERE token = '$token'");

    }

    public function getRoles(){
        return $this->database->query("SELECT * FROM rol WHERE id != 2");
    }

    public function getUsuariosPorRol($id_rol){
        return $this->database->query("SELECT * FROM usuario WHERE id_rol = $id_rol");
    }
}