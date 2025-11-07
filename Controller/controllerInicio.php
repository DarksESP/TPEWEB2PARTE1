<?php

require_once './View/viewErrores.php';
require_once './View/viewInicio.php';

class ControllerInicio
{

    private $viewErrores;
    private $viewInicio;

    
   

    public function __construct()
    {
        $this->viewErrores = new ViewErrores();
        $this->viewInicio = new ViewInicio();
       
    }


    public function showInicio () {
    
        $this->viewInicio->showInicio();
    }

   
}