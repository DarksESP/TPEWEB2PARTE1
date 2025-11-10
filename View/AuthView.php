<?php

class AuthView {
    private $user = null;
  public function __construct(){
    
   }

    public function showLogin($error = '') {
        require_once './Templates/head.phtml';
        require_once './Templates/formUser/formIniciarSesion.phtml';
        require_once './Templates/footer.phtml';
    }

   
}