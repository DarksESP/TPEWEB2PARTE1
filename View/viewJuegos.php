<?php

class ViewJuegos
{

   public function __construct()
   {

   }





   public function showJuegos($juegos, $consolas)
   {
      require_once './Templates/head.phtml';
      require_once './Templates/showJuegos/showJuegosBotonAgregar.phtml';
      require_once './Templates/showJuegos/showJuegosVerComo.phtml';
      require_once './Templates/showJuegos/showJuegosCard/showJuegosCuerpo.phtml';
      require_once './Templates/footer.phtml';
   }

   public function showJuegosLista($juegos, $consolas, $mensaje = '')
   {

      require_once './Templates/head.phtml';
       require_once './Templates/showMensaje.phtml';
      require_once './Templates/showJuegos/showJuegosBotonAgregar.phtml';
      require_once './Templates/showJuegos/showJuegosVerComo.phtml';
      require_once './Templates/showJuegos/showLista/showListaHeaderTable.phtml';
      require_once './Templates/showJuegos/showLista/showJuegosListaCuerpo.phtml';
      require_once './Templates/footer.phtml';
   }
   public function showJuego($juego, $consolas) 
   {

      require_once './Templates/head.phtml';
      require_once './Templates/showJuegos/showJuegosBotonAgregar.phtml';
      require_once './Templates/showJuegos/showJuegoVerComo.phtml';
      require_once './Templates/showJuegos/showJuegosCard/showJuegoCuerpo.phtml';

      require_once './Templates/footer.phtml';
   }

   public function showJuegoLista($juego, $consolas)
   {

      require_once './Templates/head.phtml';
      require_once './Templates/showJuegos/showJuegosBotonAgregar.phtml';
      require_once './Templates/showJuegos/showJuegoVerComo.phtml';
      require_once './Templates/showJuegos/showLista/showListaHeaderTable.phtml';
      require_once './Templates/showJuegos/showLista/showJuegoListaCuerpo.phtml';
      require_once './Templates/footer.phtml';
   }

   public function showJuegosByCategoria($juegos, $consolas, $mensaje = "")
   {

      require_once './Templates/head.phtml';
      require_once './Templates/showJuegos/showJuegosBotonAgregar.phtml';
      require_once './Templates/showJuegos/showJuegosBotonByCategoria.phtml';
      require_once './Templates/showJuegos/showJuegosCard/showJuegosCuerpo.phtml';
      require_once './Templates/footer.phtml';
   }
   public function showJuegosListaByCategoria($juegos, $consolas, $mensaje = '')
   {

      require_once './Templates/head.phtml';
      require_once './Templates/showJuegos/showJuegosBotonAgregar.phtml';
      require_once './Templates/showJuegos/showJuegosBotonByCategoria.phtml';
      require_once './Templates/showJuegos/showLista/showListaHeaderTable.phtml';
      require_once './Templates/showJuegos/showLista/showJuegosListaCuerpo.phtml';
      require_once './Templates/footer.phtml';
   }

   public function showFormAgregar($consolas)
   {
      require_once './Templates/head.phtml';
      require_once './Templates/formJuegos/formAgregarJuego.phtml';
      require_once './Templates/footer.phtml';
   }


   public function showFormEditar($id, $consolas, $juego)
   {
      require_once './Templates/head.phtml';
      require_once './Templates/formJuegos/formEditarJuego.phtml';
      require_once './Templates/footer.phtml';
   }




}
?>