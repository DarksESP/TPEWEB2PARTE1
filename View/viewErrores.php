<?php

class ViewErrores{
   
   public function __construct(){
    
   }

public function showMensaje($mensajes){
      require_once './Templates/head.phtml';
      require_once './Templates/showMensaje.phtml';
   }
}

?>