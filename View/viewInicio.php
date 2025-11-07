<?php

class ViewInicio{
   
   public function __construct(){
    
   }

public function showInicio() {
     require_once './Templates/head.phtml';
     require_once './Templates/inicio.phtml';
     require_once './Templates/guiaRutas.phtml';
     require_once './Templates/footer.phtml';
}



}