<?php

use Dompdf\Dompdf;
require_once 'third-party/dompdf/autoload.inc.php';

// al crear un controller hay que crear:
/*
    model
    vista
    y agregar respectivas cosas en helpers/configuration
*/
class ArticuloController {
    private $articuloModel;
    private $publicacionModel;
    private $seccionModel;
    private $edicionModel;
    private $render;

    public function __construct($articuloModel, $seccionModel, $publicacionModel, $edicionModel, $render){
        $this->articuloModel = $articuloModel;
        $this->seccionModel = $seccionModel;
        $this->publicacionModel = $publicacionModel;
        $this->edicionModel = $edicionModel;
        $this->render = $render;
    }

    public function getArticulo(){
        $id = $_GET["id"];
        $articulo = $this->articuloModel->getArticulo($id);
        
        echo $this->render->render("view/articulo/articulo.php", array("articulo" => $articulo));
    }

    public function accionesArticulo($notificacion = ""){
        $publicaciones = $this->publicacionModel->getPublicaciones();

        echo $this->render->render("view/articulo/accionesArticulo.php", array("publicaciones" => $publicaciones, "notificacion" => $notificacion));
    }

    private function getEdicionSeccion($id_edicion, $id_seccion ){
        return $this->edicionModel->getEdicionSeccion($id_edicion, $id_seccion);
    }

    private function validacionArticulo($valor){
        return empty($valor);
    }

    public function procesarArticulo(){
        $accion = $_POST["accion"];
        $articulo["titulo"] = $_POST["titulo"];
        $articulo["bajada"] = $_POST["bajada"];
        $articulo["contenido"] = $_POST["contenido"];
        $articulo["id_usuario_creador"] = $_SESSION["usuario"][0]["id"]; // ver de crear una variable en session con los datos mas importante del usuario que se logueó
        $articulo["id_estado"] = 3; // 1 -> draft, 2 -> a publicar, 3 -> publicado , 4 -> dado de baja 

        $articulo["fotos"] = $this->procesar_imagen($_FILES["imagen"]);
        if($accion == "editar"){
            $articulo["id"] = $_POST["id"];
        }
        // ver como hacer en esta parte con la img 
        $errores_validacion = false;
        foreach($articulo as $clave => $valor){
            if($accion == "editar" && $clave == "fotos"){
                break;
            } else {
                if($errores_validacion){
                    $this->accionesArticulo("Hubo un error en la carga del articulo");
                    exit;
                }
            }


            $errores_validacion = $this->validacionArticulo($valor);
        }
                
        if (isset($_POST["id_publicacion"]) && isset($_POST["id_seccion"])){
            $id_publicacion = $_POST["id_publicacion"];
            $id_seccion = $_POST["id_seccion"];
            $id_edicion = $this->edicionModel->getUltimaEdicionDePublicacion($id_publicacion);
            $articulo["id_edicionSeccion"] = $this->getEdicionSeccion($id_edicion, $id_seccion);
        } else {
            $this->accionesArticulo("No se selecciono Publicacion o Seccion");
            exit;
        }

        $articulo["lat"] = $_POST["lat"];
        $articulo["lon"] = $_POST["lon"];
       
        $response = $accion == "crear" ? $this->articuloModel->crearArticulo($articulo) : $this->articuloModel->editarArticulo($articulo) ;

        if ($response == 1){
            header('Location: /user/panelAdmin');
            exit;
        } else {
            $accion == "crear" ? $this->accionesArticulo("No se pudo crear el articulo") : $this->accionesArticulo("No se pudo editar el articulo");
            exit;
        }        
             
    }

    private function procesar_imagen($img){
        if (!empty($img["name"])){
            $code = bin2hex(random_bytes(16));
            $type = explode("/", $img["type"])[1];
            $nombre = "img-articulo-$code.$type";
            
            $carpeta_destino = $_SERVER["DOCUMENT_ROOT"] . "/public/img/articulos/";
            move_uploaded_file($img["tmp_name"],$carpeta_destino . $nombre);
            return $nombre;
        } else {
            //$this->accionesArticulo("No se reconoció la imagen correctamente");
            //exit;
        }
    }

    public function listar_articulos(){
        $articulos = $this->articuloModel->getArticulos();
        echo $this->render->render("view/articulo/listaArticulos.php",array("articulos" => $articulos));
    }

    public function editarArticulo(){
        $id_articulo = $_GET["id"];
        $articulo = $this->articuloModel->getArticulo($id_articulo)[0];
        $publicaciones = $this->publicacionModel->getPublicaciones();
        $secciones = $this->seccionModel->getSecciones();
        foreach($publicaciones as &$publicacion){
            $publicacion["selected"] = false;
            if($publicacion["id"] == $articulo["id_publicacion"]){
                $publicacion["selected"] = true;
            }
        }
        echo $this->render->render("view/articulo/accionesArticulo.php",array("id_articulo" => $articulo["id_articulo"],
                                                                           "id_publicacion" => $articulo["id_publicacion"],
                                                                           "titulo" => $articulo["titulo"],
                                                                           "bajada" => $articulo["bajada"], 
                                                                           "img" => $articulo["fotos"],
                                                                           "contenido" => $articulo["contenido"],
                                                                           "lat" => $articulo["lat"],
                                                                           "lon" => $articulo["lon"],
                                                                           "publicaciones" => $publicaciones));
    }

    public function pdfArticulo (){
        $id = $_GET["id"];
        $articulo = $this->articuloModel->getArticulo($id);
        
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
                echo "Articulo al : " . date("d-m-Y h:i:sa");
                ?>
            <br>
            <br>
            <h4>
                <?php echo $articulo[0]["seccion"]; ?>
            </h4>
            <h2>
                <?php echo $articulo[0]["titulo"]; ?>
            </h2>
            <h4>
               <?php echo $articulo[0]["bajada"]; ?>
            </h4>

            <div>
                <?php echo $articulo[0]["contenido"]; ?>
            </div>
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
        $dompdf->stream($articulo[0]["titulo"], ['Attachment' => 1]);
    }
}