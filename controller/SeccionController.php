<?php

// al crear un controller hay que crear:
/*
    model
    vista
    y agregar respectivas cosas en helpers/configuration
*/
class SeccionController {
    private $seccionModel;
    private $render;

    public function __construct($seccionModel, $render){
        $this->seccionModel = $seccionModel;
    }
}