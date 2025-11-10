<?php

class ViewConsola{
   
   public function __construct(){
   
   }

    public function showConsolas($consolas, $mensaje = '') {
    require_once './Templates/head.phtml';
   require_once './Templates/showConsolas/showConsolas.phtml';
   require_once './Templates/footer.phtml';
}

public function showConsola($consola) {
      
      require_once './Templates/head.phtml';
   require_once './Templates/showConsolas/showConsola.phtml';
   require_once './Templates/footer.phtml';
}

public function showFormEditar($id) {
   require_once './Templates/head.phtml';
   require_once './Templates/formConsolas/formEditarConsola.phtml';
   require_once './Templates/footer.phtml';
}

public function showFormAgregarConsola() {
 require_once './Templates/head.phtml';
   require_once './Templates/formConsolas/formAgregarConsola.phtml';
   require_once './Templates/footer.phtml';
}


}

?>




