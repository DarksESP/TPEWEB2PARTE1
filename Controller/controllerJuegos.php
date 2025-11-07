<?php

require_once './View/viewErrores.php';
require_once './View/viewJuegos.php';
require_once './Model/modelJuegos.php';
require_once './Model/modelConsolas.php';

class ControllerJuegos
{

    private $viewErrores;
    private $viewJuegos;

    
    private $modelJuegos;
    private $modelConsolas;


    public function __construct()
    {
        $this->viewErrores = new ViewErrores();
        $this->viewJuegos = new ViewJuegos();
        $this->modelJuegos = new ModelJuegos();
        $this->modelConsolas = new ModelConsolas();
    }

   

    public function showJuegos()
    {
        $juegos = $this->modelJuegos->getJuegos();
        $consolas = $this->modelConsolas->getConsolas();
        $this->viewJuegos->showJuegos($juegos, $consolas);
    }


    public function showJuego($id)
    {
        $juego = $this->modelJuegos->getJuegoByID($id);
        if (empty($juego)) {
            $this->viewErrores->showMensaje("NO EXISTE UN JUEGO DE ID $id en la base de datos");
        } else {
            $consolas = $this->modelConsolas->getConsolas();
            $this->viewJuegos->showJuego($juego, $consolas);

        }
    }

    public function showJuegoByConsola($consola)
    {
        $juegos = $this->modelJuegos->getJuegosByConsola($consola);
        $consolas = $this->modelConsolas->getConsolas();
        $this->viewJuegos->showJuegos($juegos, $consolas);
    }




    public function showFormAgregar()
    {
        $consolas = $this->modelConsolas->getConsolas();
            $this->viewJuegos->showFormAgregar($consolas);
        }

    
        public function agregarJuego() {
              if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if (
                empty($_POST['nombre']) ||
                empty($_POST['id_consola']) ||
                empty($_POST['genero']) 
               
            ) {
                $this->viewErrores->showMensaje('ingrese los datos correctamente');

            } else {
                $nombre = $_POST['nombre'];
                $consola = $_POST['id_consola'];
                $genero = $_POST['genero'];


                if (
                    !empty($_FILES['imagen']['name']) &&
                    (
                        $_FILES['imagen']['type'] == "image/jpg" ||
                        $_FILES['imagen']['type'] == "image/jpeg" ||
                        $_FILES['imagen']['type'] == "image/png"
                    )
                ) {
                    $this->modelJuegos->agregarJuego($nombre, $consola, $genero, $_FILES['imagen']);
                } else {


                    $this->modelJuegos->agregarJuego($nombre, $consola, $genero);
                    $this->viewErrores->showMensaje('error al procesar la imagen');
                }


                $this->showJuegos();
            

            }}
            else {
                $this->showJuegos();
            }
        }
    public function eliminarJuego($id)
    {

        if (empty($this->modelJuegos->getJuegoByID($id))) {
            $this->viewErrores->showMensaje("NO SE ENCONTRÓ UN JUEGO CON EL ID $id --- ERROR 404 NOT FOUND");
        }
        else {

            $this->modelJuegos->eliminarJuego($id);
            $this->showJuegos();
        }
    }

    public function showFormEditar($id) {

        $juego = $this->modelJuegos->getJuegoByID($id);

        if (empty($juego)) {
            $this->viewErrores->showMensaje("NO EXISTE UN JUEGO CON EL ID $id --- ERROR 404 NOT FOUND");
        }

        else {
            $consolas = $this->modelConsolas->getConsolas();
            $this->viewJuegos->showFormEditar($id, $consolas);

        }

    }
    

        



      
        
    
        public function editarJuego() {

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (
                    empty($_POST['nombre']) || empty($_POST['genero']) ||  empty($_POST['id_juego'])
                   || empty($_POST['id_consola']))
                    
                {
                    $this->viewErrores->showMensaje('ingrese los datos correctamente');
    
                } else {
                    $nombre = $_POST['nombre'];
                    $consola = $_POST['id_consola'];
                    $id_juego = $_POST['id_juego'];
                    $genero = $_POST['genero'];
    
    
    
                    if (
                        !empty($_FILES['imagen']['name']) &&
                        (
                            $_FILES['imagen']['type'] == "image/jpg" ||
                            $_FILES['imagen']['type'] == "image/jpeg" ||
                            $_FILES['imagen']['type'] == "image/png"
                        )
                    ) {
                        $this->modelJuegos->editarJuego($nombre, $consola, $genero, $id_juego, $_FILES['imagen']);
                    } else {
    
    
    
                        $this->modelJuegos->editarJuego($nombre, $consola, $genero, $id_juego);
                        $this->viewErrores->showMensaje('error al procesar la imagen');
                        
                                     
    
    
                    }
    
    
                    $this->showJuegos();
                }
    
            }

            else {
                $this->showJuegos();
            }
        }
    
       
        

   


    }
?>