<?php
require_once "./View/viewConsola.php";
require_once "./View/viewErrores.php";

require_once "./Model/modelConsolas.php";
class ControllerConsola
{

    private $viewConsola;
    private $viewErrores;

    private $modelConsolas;


    public function __construct()
    {
        $this->viewConsola = new ViewConsola();
        $this->viewErrores = new ViewErrores();
        $this->modelConsolas = new ModelConsolas();
    }

    public function showConsolas()
    {

        $consolas = $this->modelConsolas->getConsolas();

        $this->viewConsola->showConsolas($consolas);


    }

    public function showConsola($id)
    {
        $consola = $this->modelConsolas->getConsolaByID($id);

        if (empty($consola)) {
            $this->viewErrores->showMensaje("404 NOT FOUND -------");
        } else {
            $this->viewConsola->showConsola($consola);
        }
    }

    public function showFormAgregarConsola(){
        $this->viewConsola->showFormAgregarConsola();
    }





    public function agregarConsola()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if (
                empty($_POST['nombre']) ||
                empty($_POST['empresa'])

            ) {
                $this->viewErrores->showMensaje('ingrese los datos correctamente');

            } else {
                $nombre = $_POST['nombre'];
                $empresa = $_POST['empresa'];



                if (
                    !empty($_FILES['imagen']['name']) &&
                    (
                        $_FILES['imagen']['type'] == "image/jpg" ||
                        $_FILES['imagen']['type'] == "image/jpeg" ||
                        $_FILES['imagen']['type'] == "image/png"
                    )
                ) {
                    $this->modelConsolas->agregarConsola($nombre, $empresa, $_FILES['imagen']);
                } else {


                    $this->modelConsolas->agregarConsola($nombre, $empresa);
                    $this->viewErrores->showMensaje('error al procesar la imagen');
                }


                $this->showConsolas();


            }
        }

        else {
            $this->showConsolas();
        }
    }


    public function eliminarConsola($id)
    {
        $consola = $this->modelConsolas->getConsolaByID($id);

        if (empty($consola)) {
            $this->viewErrores->showMensaje("404 NOT FOUND, CONSOLA NO ENCONTRADA");
        } else {
            $this->modelConsolas->eliminarConsolaByID($id);
            $this->showConsolas();
        }
    }

    public function showFormEditarConsola($id)
    {

        $consola = $this->modelConsolas->getConsolaByID($id);

        if (empty($consola)) {
            $this->viewErrores->showMensaje("NO EXISTE UNA CONSOLA CON EL ID $id --- ERROR 404 NOT FOUND");
        } else {


            $this->viewConsola->showFormEditar($id);




        }

    }

        public function editarConsola() {

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (
                    empty($_POST['nombre']) || empty($_POST['empresa']) ||  empty($_POST['id_consola'])
                )
                    
                {
                    $this->viewErrores->showMensaje('ingrese los datos correctamente');
    
                } else {
                    $nombre = $_POST['nombre'];
                    $consola = $_POST['id_consola'];
                    $empresa = $_POST['empresa'];
    
    
    
                    if (
                        !empty($_FILES['imagen']['name']) &&
                        (
                            $_FILES['imagen']['type'] == "image/jpg" ||
                            $_FILES['imagen']['type'] == "image/jpeg" ||
                            $_FILES['imagen']['type'] == "image/png"
                        )
                    ) {
                        $this->modelConsolas->editarConsola($nombre, $empresa, $consola, $_FILES['imagen']);
                    } else {
    
    
    
                        $this->modelConsolas->editarConsola($nombre, $empresa, $consola);
                        $this->viewErrores->showMensaje('error al procesar la imagen');
                        
                                     
    
    
                    }
    
    
                    $this->showConsolas();
                }
    
            }

            else {
                $this->showConsolas();
            }
        }
    

}