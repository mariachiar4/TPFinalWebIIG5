<?php
include_once("helpers/MysqlDatabase.php");
include_once("helpers/Render.php");
include_once("helpers/UrlHelper.php");

include_once("model/UserModel.php");
include_once("model/PublicacionModel.php");
include_once("model/EdicionModel.php");

include_once("controller/UserController.php");
include_once("controller/PublicacionController.php");
include_once("controller/EdicionController.php");

include_once('third-party/mustache/src/Mustache/Autoloader.php');
include_once("Router.php");

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
        $publicacionModel = $this->getPublicacionModel();
        return new UserController($userModel, $publicacionModel, $this->getRender());
    }

    public function getPublicacionModel(){
        $database = $this->getDatabase();
        return new PublicacionModel($database);
    }

    public function getPublicacionController(){
        $publicacionModel = $this->getPublicacionModel();
        return new PublicacionController($publicacionModel, $this->getRender());
    }

    public function getEdicionModel(){
        $database = $this->getDatabase();
        return new EdicionModel($database);
    }

    public function getEdicionController(){
        $edicionModel = $this->getEdicionModel();
        return new EdicionController($edicionModel, $this->getRender());
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