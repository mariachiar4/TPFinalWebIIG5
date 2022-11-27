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
        $confirmado = $data["confirmado"];

        $usuarioEncontrado = $this->database->query("SELECT * FROM validacion WHERE email = '$email' ");
        
        if (count($usuarioEncontrado) === 0){
            $usuarioAgregado = $this->database->execute("INSERT INTO usuario VALUES (null, $id_rol, '$nombre', $lat, $lon, '$email')"); 
            if($usuarioAgregado > 0) return $this->database->execute("INSERT INTO validacion VALUES ('$email', '$hash', '$token', $confirmado)") === 1 ? "registrado" : "error";
        
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
    public function getUsuarios(){
        return $this->database->query("SELECT u.id, r.nombre as rol, u.nombre, u.email FROM usuario u
                                       LEFT JOIN rol r ON r.id = u.id_rol 
                                       WHERE r.id != 2");
    }

    public function editarUsuario($id, $nombre){
        return $this->database->execute("UPDATE usuario SET nombre = '$nombre' WHERE id = $id");
    }
    public function eliminarUsuario($id, $email){
        $usuarioEliminado = $this->database->execute("DELETE FROM usuario WHERE id = $id");
        if($usuarioEliminado > 0) return $this->database->execute("DELETE FROM validacion WHERE email = '$email'");
    }


    public function suscripcion($id_usuario,$id_publicacion){
        $fecha_inicio = date("Y-m-d H:i:s");
        $fecha_fin = strtotime('+1 month', strtotime($fecha_inicio));
        $fecha_fin = date("Y-m-d H:i:s", $fecha_fin);

        return $this->database->execute("INSERT INTO suscripcion (id_usuario, id_publicacion, fecha_inicio, fecha_fin) 
                    VALUES ($id_usuario, $id_publicacion, '$fecha_inicio', '$fecha_fin')"); 
    }


    public function obtenerReportes($fecha_inicio, $fecha_fin){
        $comienzo = new DateTime($fecha_inicio);
        $final = new DateTime($fecha_fin);
        $final = $final->modify('+1 day');
        
        $intervalo = DateInterval::createFromDateString('1 day');
        $periodo = new DatePeriod($comienzo, $intervalo, $final);

        $labels = [];

        foreach($periodo as $dt) {
            array_push($labels, $dt->format("Y-m-d"));
        }
    
        $response = $this->database->query("SELECT fecha_inicio , count(*) as cantidad FROM suscripcion GROUP BY fecha_inicio  ORDER BY fecha_inicio");        
        $data = array();

        foreach($labels as $label){
            $encontroDato = false;
            foreach($response as $elem){
                if($label == $elem["fecha_inicio"]){
                    array_push($data,$elem["cantidad"]);
                    $encontroDato = true;
                }
            }
            if ($encontroDato == false){
                array_push($data,0);
            }
        }
        $result = array (
            "labels" => $labels, "data" => $data
        );
        return $result;
    }
}
