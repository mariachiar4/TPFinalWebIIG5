<?php
include_once("helpers/MysqlDatabase.php");
include_once("helpers/Render.php");
include_once("helpers/UrlHelper.php");

include_once("model/UserModel.php");

include_once("controller/UserController.php");

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
        return new UserController($userModel, $this->getRender());
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