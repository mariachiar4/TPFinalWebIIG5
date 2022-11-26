<?php

use Dompdf\Dompdf;
require_once 'third-party/dompdf/autoload.inc.php';

class UserController {
    private $userModel;
    private $render;

    public function __construct($userModel, $render){
        $this->userModel = $userModel;
        $this->render = $render;
    }


    public function registrarse(){
        echo $this->render->render("view/register.php");
    }

    public function registrarContenidista(){
        echo $this->render->render("view/registrarContenidista.php");
    }
    public function procesarRegistroContenidista(){
        $data["nombre"] = $_POST["nombre"];
        $data["email"]  = $_POST["email"];
        $data["id_rol"]  = 1;
        $data["password"]  = $_POST["password"];
        $data["lat"]  = 0;
        $data["lon"]  = 0;
        $data["confirmado"] = 1;
        $data["token"] = "";
        $errores_validacion = false;
        foreach($data as $clave => $valor){
            if($errores_validacion){
                break;
            }
            $errores_validacion = $this->validacion($clave, $valor);
        }
        $resultadoRegistro = $this->userModel->insertarUsuario($data);

        if ($resultadoRegistro === "registrado"){
            $this->accionesUsuarios("Contenidista creado exitosamente");
            exit;
        } else {
            echo $this->render->render("view/registradoError.php", array("error" => $resultadoRegistro));
        }
    }
    // procesa el registro del Lector
    public function procesarRegistro(){
        $data["nombre"] = $_POST["nombre"];
        $data["email"]  = $_POST["email"];
        $data["id_rol"]  = 3;
        $data["password"]  = $_POST["password"];
        $data["lat"]  = !empty($_POST["lat"]) ? $_POST["lat"] : 0;
        $data["lon"]  = !empty($_POST["lon"]) ? $_POST["lon"] : 0;
        $data["confirmado"] = 0;

        $errores_validacion = false;
        foreach($data as $clave => $valor){
            if($errores_validacion){
                break;
            }
            $errores_validacion = $this->validacion($clave, $valor);
        }

        $token = bin2hex(random_bytes(16)); 
        $data["token"]  = $token;

        $resultadoRegistro = $this->userModel->insertarUsuario($data);
    
        if ($resultadoRegistro === "registrado"){
            //mandarmail
            $this->enviarEmail($data, $token);
            echo $this->render->render("view/registradoOk.php", array("nombre" => $data["nombre"]) );
        } else {
            echo $this->render->render("view/registradoError.php", array("error" => $resultadoRegistro) );
        }
    }

    private function enviarEmail($data,$token){
        Validator::enviarMail($data["email"], 
        'Bienvenid@! Active su cuenta de Infonete',
        "
        <h3>Gracias Por Registrarte en Infonete</h3>
        <p>Por favor clickea en el siguiente link para validar tu cuenta!</p>
        <a style='background-color: #17c; color: #fff; cursor: pointer; width: 250px; padding: 6px; outline: 0; font-size:1.2rem; text-decoration:none;' 
        target='_blank' rel='noopener noreferrer' href='localhost/user/verificarUsuario?token=$token'>Confirmar Email</a>");
    }

    public function verificarUsuario(){
        $token = $_GET["token"];
        
        $validadoIsOk = $this->userModel->verificarUsuario($token);

        if($validadoIsOk){
            echo $this->render->render("view/cuentaValidada.php" );
        } else {
            echo $this->render->render("view/errorDeValidacion.php" );
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

        $usuarioEncontrado = $this->userModel->getUsuario($data);
        $usuarioConfirmado = count($usuarioEncontrado) > 0 ? $usuarioEncontrado[0]["confirmado"] : null;

        if ($usuarioEncontrado) {
            if ($usuarioConfirmado){
                $_SESSION["logueado"] = true;
                $_SESSION["usuario"] = $this->userModel->getInformacionDelUsuario($data["email"]);
                header('Location: /publicacion'); 
            } else {
                echo $this->render->render("view/login.php",array("error" => "Cuenta no verificada! Revisa tu Email!"));
            }

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

    public function panelAdmin(){
        echo $this->render->render("view/panelAdmin.php");
    }

    public function pdfContenidistas (){
        $contenidistas = $this->userModel->getUsuariosPorRol(1);
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        ob_start()
        ?>
        <!doctype html>
        <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>
        <body>
           <?php date_default_timezone_set("America/Argentina/Buenos_Aires");
                echo "Informe al : " . date("d-m-Y h:i:sa");
                ?>
            <br>
            <br>
            <h3>Contenidistas</h3>
            <table border="1">
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Lat</td>
                    <td>Lon</td>
                    <td>Email</td>
                </tr>
                <?php 
                foreach ($contenidistas as $value) {?>
                <tr>
                    <td>
                        <?php echo $value["id"]; ?>
                    </td>
                    <td>
                        <?php echo $value["nombre"]; ?>
                    </td>
                    <td>
                        <?php echo $value["lat"]; ?>
                    </td>
                    <td>
                        <?php echo $value["lon"]; ?>
                    </td>
                    <td>
                        <?php echo $value["email"]; ?>
                    </td>
                </tr><?php
                }
                ?>
            </table>
        </body>
        </html>
        <?php
        $html = ob_get_clean();
        $dompdf->loadHtml(utf8_decode($html));
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream("Contenidistas.pdf", ['Attachment' => 1]);
    }

    public function pdfLectores (){
        $lectores = $this->userModel->getUsuariosPorRol(3);
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        ob_start()
        ?>
        <!doctype html>
        <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>
        <body>
           <?php date_default_timezone_set("America/Argentina/Buenos_Aires");
                echo "Informe al : " . date("d-m-Y h:i:sa");
                ?>
            <br>
            <br>
            <h3>Lectores</h3>
            <table border="1">
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Lat</td>
                    <td>Lon</td>
                    <td>Email</td>
                </tr>
                <?php 
                foreach ($lectores as $value) {?>
                <tr>
                    <td>
                        <?php echo $value["id"]; ?>
                    </td>
                    <td>
                        <?php echo $value["nombre"]; ?>
                    </td>
                    <td>
                        <?php echo $value["lat"]; ?>
                    </td>
                    <td>
                        <?php echo $value["lon"]; ?>
                    </td>
                    <td>
                        <?php echo $value["email"]; ?>
                    </td>
                </tr><?php
                }
                ?>
            </table>
        </body>
        </html>
        <?php
        $html = ob_get_clean();
        $dompdf->loadHtml(utf8_decode($html));
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream("Lectores.pdf", ['Attachment' => 1]);
    }
        

    public function accionesUsuarios($notificacion = null){
        $usuarios = $this->userModel->getUsuarios();
        echo $this->render->render("view/accionesUsuarios.php", array("usuarios" => $usuarios, "notificacion" => $notificacion));
    }

    public function procesarAccionUsuario(){
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $accion = $_POST["accion"];

        if($accion == "Editar"){
            $response = $this->userModel->editarUsuario($id, $nombre);
            $this->accionesUsuarios($response === 1 ? "Editado Correcto de id: $id" : "No se ha podido editar");
            exit;

        }else{
            $response = $this->userModel->eliminarUsuario($id, $email);
            $this->accionesUsuarios($response === 1 ? "Eliminado Correcto de id: $id" : "No se ha podido eliminar");
            exit;
        }
    }

    public function suscripcion(){
        $id_publicacion = isset($_POST["id_publicacion"]) ? $_POST["id_publicacion"] : null;
        $id_usuario = isset($_SESSION["usuario"]) ? $_SESSION["usuario"][0]["id"] : null;
        
        if($id_publicacion && $id_usuario){
            $this->userModel->suscripcion($id_usuario,$id_publicacion);
            header('Location: /');
            exit;
        } else {
            header('Location: /');
            exit;
        }
    }
    public function reportes(){
        $suscripciones = "";
        echo $this->render->render("view/reportes.php", array("suscripciones" => $suscripciones));
    }


}