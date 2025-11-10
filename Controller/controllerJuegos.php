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
    public function showJuegosLista()
    {
        $juegos = $this->modelJuegos->getJuegos();
        $consolas = $this->modelConsolas->getConsolas();
        $this->viewJuegos->showJuegosLista($juegos, $consolas);
    }

    public function showJuegosListaByCategoria($id)
    {
        $juegos = $this->modelJuegos->getJuegosByConsola($id);
        $consolas = $this->modelConsolas->getConsolas();
        $this->viewJuegos->showJuegosListaByCategoria($juegos, $consolas);
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

        public function showJuegoLista($id)
    {
      

            $juego = $this->modelJuegos->getJuegoByID($id);
          
            if (empty($juego)) {
              
                $this->viewErrores->showMensaje("NO EXISTE UN JUEGO DE ID $id");
            } else {
                $consolas = $this->modelConsolas->getConsolas();
                $this->viewJuegos->showJuegoLista($juego, $consolas);
    
            }
        }
    
       

    public function showJuegosByCategoria($consola)
    {
        $juegos = $this->modelJuegos->getJuegosByConsola($consola);
        $consolas = $this->modelConsolas->getConsolas();
        $this->viewJuegos->showJuegosByCategoria($juegos, $consolas);
    }
public function showAgregarJuego()
{
    if ($_SERVER['REQUEST_METHOD'] != "POST") {
        $consolas = $this->modelConsolas->getConsolas();
        $this->viewJuegos->showFormAgregar($consolas);
    } 
    else {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $mensajes = []; // Array para acumular mensajes

            if (
                empty($_POST['nombre']) ||
                empty($_POST['id_consola']) ||
                empty($_POST['genero']) ||
                empty($_POST['descripcion'])
            ) {
                $this->viewErrores->showMensaje('INGRESE LOS DATOS CORRECTAMENTE. 400');
            } 
            else {
                $nombre = $_POST['nombre'];
                $consola = $_POST['id_consola'];
                $genero = $_POST['genero'];
                $descripcion = $_POST['descripcion'];

                // -------------------------------
                // VALIDACIÓN Y SUBIDA DE IMAGEN
                // -------------------------------
                $imagen = null;
                if (
                    !empty($_FILES['imagen']['name']) &&
                    (
                        $_FILES['imagen']['type'] == "image/jpg" ||
                        $_FILES['imagen']['type'] == "image/jpeg" ||
                        $_FILES['imagen']['type'] == "image/png"
                    )
                ) {
                    $imagen = $_FILES['imagen'];
                } else if (!empty($_FILES['imagen']['name'])) {
                    $mensajes[] = "Solo se permiten imágenes JPG o PNG.";
                }

                // -------------------------------
                // VALIDACIÓN Y SUBIDA DE AUDIO
                // -------------------------------
                $audioURL = null;
                if (
                    isset($_FILES['audio']) &&
                    $_FILES['audio']['error'] === UPLOAD_ERR_OK
                ) {
                    $archivo = $_FILES['audio'];
                    $tipo = $archivo['type'];
                    $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
                    $tamanoMax = 10 * 1024 * 1024; // 10 MB

                    if (($tipo === 'audio/mpeg' || $tipo === 'audio/mp3') && $extension === 'mp3' && $archivo['size'] <= $tamanoMax) {
                        $carpetaDestino = './uploads/audios/';
                        if (!file_exists($carpetaDestino)) {
                            mkdir($carpetaDestino, 0777, true);
                        }

                        $nombreNuevo = uniqid('audio_', true) . '.mp3';
                        $rutaRelativa = 'uploads/audios/' . $nombreNuevo;
                        $rutaCompleta = $carpetaDestino . $nombreNuevo;

                        if (move_uploaded_file($archivo['tmp_name'], $rutaCompleta)) {
                            $audioURL = $rutaRelativa; // se guarda en la DB
                        } else {
                            $mensajes[] = "ERROR AL MOVER EL ARCHIVO DE AUDIO.";
                        }
                    } else {
                        $mensajes[] = "Solo se permiten archivos MP3 de hasta 10 MB.";
                    }
                }

                // -------------------------------
                // LLAMADA AL MODELO
                // -------------------------------
                if ($imagen) {
                    $this->modelJuegos->agregarJuego($nombre, $consola, $genero, $descripcion, $imagen, $audioURL);
                } else {
                    $this->modelJuegos->agregarJuego($nombre, $consola, $genero, $descripcion, null, $audioURL);
                }

                // Mensaje de éxito
                $nombre1 = strtoupper($nombre);
                $mensajes[] = "AGREGADO CON ÉXITO $nombre1";
            }

            // Mostrar todos los mensajes juntos
            $this->viewErrores->showMensaje($mensajes);

            // Redirigir o mostrar lista de juegos
            $this->showJuegos();
        } 
        else {
            $this->showJuegos();
        }
    }
}


    
       
    public function eliminarJuego($id)
    {

        if (empty($this->modelJuegos->getJuegoByID($id))) {
            $this->viewErrores->showMensaje("NO SE ENCONTRÓ UN JUEGO CON EL ID $id --- ERROR 404 NOT FOUND");
        }
        else {

            
            $this->modelJuegos->eliminarJuego($id);
            $juegos = $this->modelJuegos->getJuegos();
            $consolas = $this->modelConsolas->getConsolas();
             $mensaje = "SE HA ELIMINADO CON ÉXITO EL JUEGO DE ID $id ";
             $this->viewErrores->showMensaje($mensaje);
            $this->viewJuegos->showJuegos($juegos, $consolas);
        }
    }

    public function showFormEditar($id) {

    if ($_SERVER['REQUEST_METHOD'] != "POST") {

        $juego = $this->modelJuegos->getJuegoByID($id);

        if (empty($juego)) {
            $this->viewErrores->showMensaje("NO EXISTE UN JUEGO CON EL ID $id --- ERROR 404 NOT FOUND");
        } else {
            $consolas = $this->modelConsolas->getConsolas();
            $this->viewJuegos->showFormEditar($id, $consolas, $juego); // pasamos también el juego actual
        }

    } else { // POST

        if (empty($_POST['nombre']) || empty($_POST['genero']) || empty($_POST['id_juego']) ||
            empty($_POST['id_consola']) || empty($_POST['descripcion'])) {

            $this->viewErrores->showMensaje('Ingrese los datos correctamente');

        } else {

            $nombre = $_POST['nombre'];
            $consola = $_POST['id_consola'];
            $id_juego = $_POST['id_juego'];
            $genero = $_POST['genero'];
            $descripcion = $_POST['descripcion'];

            $mensajes = []; // Array para acumular mensajes

            // -------------------------------
            // VALIDACIÓN Y SUBIDA DE IMAGEN
            // -------------------------------
            $imagen = null;
            if (!empty($_FILES['imagen']['name'])) {
                $tipoImagen = $_FILES['imagen']['type'];
                if ($tipoImagen == "image/jpg" || $tipoImagen == "image/jpeg" || $tipoImagen == "image/png") {
                    $imagen = $_FILES['imagen'];
                } else {
                    $mensajes[] = "Solo se permiten imágenes JPG o PNG.";
                }
            }

            // -------------------------------
            // VALIDACIÓN Y SUBIDA DE AUDIO (solo MP3)
            // -------------------------------
            $audioURL = null;
            if (isset($_FILES['audio']) && $_FILES['audio']['error'] === UPLOAD_ERR_OK) {
                $archivo = $_FILES['audio'];
                $tipo = $archivo['type'];
                $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
                $tamanoMax = 10* 1024 * 1024; // 10 MB

                if (($tipo === 'audio/mpeg' || $tipo === 'audio/mp3') && $extension === 'mp3' && $archivo['size'] <= $tamanoMax) {
                    $carpetaDestino = './uploads/audios/';
                    if (!file_exists($carpetaDestino)) {
                        mkdir($carpetaDestino, 0777, true);
                    }

                    $nombreNuevo = uniqid('audio_', true) . '.mp3';
                    $rutaRelativa = 'uploads/audios/' . $nombreNuevo;
                    $rutaCompleta = $carpetaDestino . $nombreNuevo;

                    if (move_uploaded_file($archivo['tmp_name'], $rutaCompleta)) {
                        $audioURL = $rutaRelativa; // se guarda en la DB
                    } else {
                        $mensajes[] = "Error al mover el archivo de audio.";
                    }
                } else {
                    $mensajes[] = "Solo se permiten archivos MP3 de hasta 10 MB.";
                }
            }

            // -------------------------------
            // LLAMADA AL MODELO
            // -------------------------------
            $this->modelJuegos->editarJuego($nombre, $consola, $genero, $descripcion, $id_juego, $imagen, $audioURL);

            // Mensaje de éxito
            $mensajes[] = "EDITADO CON ÉXITO EL JUEGO DE ID: $id_juego";

            // Mostrar todos los mensajes
            $this->viewErrores->showMensaje($mensajes);

            // Redirigir o mostrar lista de juegos
            $this->showJuegos();
        }
    }
}

}
 /*
public function showFormEditar($id) {

    if ($_SERVER['REQUEST_METHOD'] != "POST") {

        $juego = $this->modelJuegos->getJuegoByID($id);

        if (empty($juego)) {
            $this->viewErrores->showMensaje("NO EXISTE UN JUEGO CON EL ID $id --- ERROR 404 NOT FOUND");
        } else {
            $consolas = $this->modelConsolas->getConsolas();
            $this->viewJuegos->showFormEditar($id, $consolas, $juego); // pasamos también el juego actual
        }

    } else { // POST

        if (empty($_POST['nombre']) || empty($_POST['genero']) || empty($_POST['id_juego']) ||
            empty($_POST['id_consola']) || empty($_POST['descripcion'])) {

            $this->viewErrores->showMensaje('Ingrese los datos correctamente');

        } else {

            $nombre = $_POST['nombre'];
            $consola = $_POST['id_consola'];
            $id_juego = $_POST['id_juego'];
            $genero = $_POST['genero'];
            $descripcion = $_POST['descripcion'];

            $mensajes = []; // Array para acumular mensajes

            // -------------------------------
            // VALIDACIÓN Y SUBIDA DE IMAGEN
            // -------------------------------
            $imagen = null;
            if (!empty($_FILES['imagen']['name'])) {
                $tipoImagen = $_FILES['imagen']['type'];
                if ($tipoImagen == "image/jpg" || $tipoImagen == "image/jpeg" || $tipoImagen == "image/png") {
                    $imagen = $_FILES['imagen'];
                } else {
                    $mensajes[] = "Solo se permiten imágenes JPG o PNG.";
                }
            }

            // -------------------------------
            // VALIDACIÓN Y SUBIDA DE AUDIO (solo MP3)
            // -------------------------------
            $audioURL = null;
            if (isset($_FILES['audio']) && $_FILES['audio']['error'] === UPLOAD_ERR_OK) {
                $archivo = $_FILES['audio'];
                $tipo = $archivo['type'];
                $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
                $tamanoMax = 10 * 1024 * 1024; // 10 MB

                if (($tipo === 'audio/mpeg' || $tipo === 'audio/mp3') && $extension === 'mp3' && $archivo['size'] <= $tamanoMax) {
                    $carpetaDestino = './uploads/audios/';
                    if (!file_exists($carpetaDestino)) {
                        mkdir($carpetaDestino, 0777, true);
                    }

                    $nombreNuevo = uniqid('audio_', true) . '.mp3';
                    $rutaRelativa = 'uploads/audios/' . $nombreNuevo;
                    $rutaCompleta = $carpetaDestino . $nombreNuevo;

                    if (move_uploaded_file($archivo['tmp_name'], $rutaCompleta)) {
                        $audioURL = $rutaRelativa; // se guarda en la DB
                    } else {
                        $this->viewErrores->showMensaje("ERROR AL MOMENTO DE SUBIR EL AUDIO");
                    }
                } else {
                    $this->viewErrores->showMensaje("Solo se permiten archivos MP3 de hasta 10 MB.");
                }
            }

            // -------------------------------
            // LLAMADA AL MODELO
            // -------------------------------
            $this->modelJuegos->editarJuego($nombre, $consola, $genero, $descripcion, $id_juego, $imagen, $audioURL);

            // Mensaje de éxito
            $mensajes[] = "EDITADO CON ÉXITO EL JUEGO DE ID: $id_juego";

            // Mostrar todos los mensajes
          

            // Redirigir o mostrar lista de juegos
            $this->showJuegos();
        }
    }
}
}

/*
    
    public function showFormEditar($id) {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {

            $juego = $this->modelJuegos->getJuegoByID($id);
    
            if (empty($juego)) {
                $this->viewErrores->showMensaje("NO EXISTE UN JUEGO CON EL ID $id --- ERROR 404 NOT FOUND");
            }
    
            else {
                $consolas = $this->modelConsolas->getConsolas();
                $this->viewJuegos->showFormEditar($id, $consolas);
    
            }
        }

        else {
             if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (
                    empty($_POST['nombre']) || empty($_POST['genero']) ||  empty($_POST['id_juego'])
                   || empty($_POST['id_consola']) || empty($_POST['descripcion']))
                    
                {
                    $this->viewErrores->showMensaje('ingrese los datos correctamente');
    
                } else {
                    $nombre = $_POST['nombre'];
                    $consola = $_POST['id_consola'];
                    $id_juego = $_POST['id_juego'];
                    $genero = $_POST['genero'];
                    $descripcion = $_POST['descripcion'];
    
    
    
                    if (
                        !empty($_FILES['imagen']['name']) &&
                        (
                            $_FILES['imagen']['type'] == "image/jpg" ||
                            $_FILES['imagen']['type'] == "image/jpeg" ||
                            $_FILES['imagen']['type'] == "image/png"
                        )
                    ) {
                        $this->modelJuegos->editarJuego($nombre, $consola, $genero, $descripcion, $id_juego, $_FILES['imagen']);
                    } else {
    
    
    
                        $this->modelJuegos->editarJuego($nombre, $consola, $genero, $descripcion, $id_juego);
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
    

        



      
        
    */
      
    
?>