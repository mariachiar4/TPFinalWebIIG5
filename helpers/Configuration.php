<?php
include_once("helpers/MysqlDatabase.php");
include_once("helpers/Render.php");
include_once("helpers/UrlHelper.php");

include_once("model/UserModel.php");
include_once("model/PublicacionModel.php");
include_once("model/EdicionModel.php");
include_once("model/ArticuloModel.php");
include_once("model/SeccionModel.php");

include_once("controller/UserController.php");
include_once("controller/PublicacionController.php");
include_once("controller/EdicionController.php");
include_once("controller/ArticuloController.php");
include_once("controller/SeccionController.php");

include_once('third-party/mustache/src/Mustache/Autoloader.php');
include_once("Router.php");

include_once("helpers/Validator.php");

class Configuration{

    private function getDatabase(){
        $config = $this->getConfig();
        return new MysqlDatabase(
            $config["servername"],
            $config["username"],
            $config["password"],
            $config["dbname"]
        );
    }

    public function getUserModel(){
        $database = $this->getDatabase();
        return new UserModel($database);
    }

    public function getUserController(){
        $userModel = $this->getUserModel();
        return new UserController($userModel, $this->getRender());
    }

    public function getPublicacionModel(){
        $database = $this->getDatabase();
        return new PublicacionModel($database);
    }

    public function getPublicacionController(){
        $publicacionModel = $this->getPublicacionModel();
        $seccionModel = $this->getSeccionModel();
        $articuloModel = $this->getArticuloModel();
        return new PublicacionController($publicacionModel, $seccionModel, $articuloModel, $this->getRender());
    }

    public function getEdicionModel(){
        $database = $this->getDatabase();
        return new EdicionModel($database);
    }

    public function getEdicionController(){
        $publicacionModel = $this->getPublicacionModel();
        $edicionModel = $this->getEdicionModel();
        $seccionModel = $this->getSeccionModel();
        return new EdicionController($edicionModel, $publicacionModel, $seccionModel, $this->getRender());
    }

    public function getArticuloModel(){
        $database = $this->getDatabase();
        return new ArticuloModel($database);
    }

    public function getArticuloController(){
        $publicacionModel = $this->getPublicacionModel();
        $articuloModel = $this->getArticuloModel();
        $seccionModel = $this->getSeccionModel();
        return new ArticuloController($articuloModel, $seccionModel, $publicacionModel, $this->getRender());
    }

    public function getSeccionModel(){
        $database = $this->getDatabase();
        return new SeccionModel($database);
    }

    public function getSeccionController(){
        $seccionModel = $this->getSeccionModel();
        return new SeccionController($seccionModel, $this->getRender());
    }

    private function getConfig(){
        return parse_ini_file("config/config.ini");
    }

    public function getRender(){
        return new Render('view/partial');
    }

    public function getRouter(){
        return new Router($this);
    }

    public function getUrlHelper(){
        return new UrlHelper();
    }
}