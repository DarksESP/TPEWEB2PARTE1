<?php

class ViewJuegos{
   
   public function __construct(){
    
   }




   
   public function showJuegos($juegos,$consolas, $mensaje = '') {
    require_once './Templates/head.phtml';
    require_once './Templates/showJuegos.phtml';
    require_once './Templates/footer.phtml';
   }
   
   public function showJuego($juego, $consolas) {
      
      require_once './Templates/head.phtml';
   require_once './Templates/showJuego.phtml';
   require_once './Templates/footer.phtml';
}

public function showFormAgregar($consolas) {
   require_once './Templates/head.phtml';
   require_once './Templates/formAgregarJuego.phtml';
   require_once './Templates/footer.phtml';
}


public function showFormEditar($id, $consolas) {
   require_once './Templates/head.phtml';
   require_once './Templates/formEditarJuego.phtml';
   require_once './Templates/footer.phtml';
}



   
}
?>
