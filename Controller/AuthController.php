<?php

//MODELS
require_once './Model/UserModel.php';
require_once './Model/modelJuegos.php';
require_once './Model/modelConsolas.php';

//VISTAS
require_once './View/authView.php';
require_once './View/viewErrores.php';
require_once './View/viewJuegos.php';

class AuthController
{
    private $modelUser;
    private $modelJuegos;
    private $modelConsolas;
    private $viewAuth;
    private $viewErrores;

    private $viewJuegos;

    public function __construct()
    {
        $this->modelUser = new UserModel();
        $this->modelJuegos = new ModelJuegos();
        $this->modelConsolas = new ModelConsolas();
        $this->viewAuth = new AuthView();
        $this->viewErrores = new ViewErrores();
        $this->viewJuegos = new ViewJuegos();
    }




    public function showLogin()
    {
 // Inicio de sesión seguro
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Si ya hay un usuario logueado, lo redirigimos al home
    if (isset($_SESSION['ID_USER'])) {
        $this->viewErrores->showMensaje("No puedes iniciar sesión más de una vez, error 400");
    }

  else if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (empty($_POST['usuario'])) {
                return $this->viewAuth->showLogin('FALTA COMPLETAR EL EMAIL');
            } else if (empty($_POST['password'])) {
                return $this->viewAuth->showLogin('FALTA COMPLETAR LA CONTRASEÑA');
            } else {
                $userName = $_POST['usuario'];
                $password = $_POST['password'];

                $userFromDB = $this->modelUser->getUserByNombre($userName);

                if ($userFromDB && password_verify($password, $userFromDB->passwordd)) {
                    // Guardo en la sesión el ID del usuario
                  
                    $_SESSION['ID_USER'] = $userFromDB->id;
                    $_SESSION['USER_NAME'] = $userFromDB->nombre;


                    // Redirijo al home
                    //    header('Location: ' . BASE_URL);
                   
                   $mensaje = "INICIO DE SESIÓN EXITOSO";
                    $juegos =$this->modelJuegos->getJuegos();
                    $consolas = $this->modelConsolas->getConsolas();
                    $this->viewJuegos->showJuegos($juegos, $consolas, $mensaje );
                } else {

                    return $this->viewAuth->showLogin('DATOS INCORRECTOS');
                }
            }

        } else {
            $this->viewAuth->showLogin();
        }

    }




    public function showLogOut()
    {

     // Inicio de sesión seguro
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Si NO hay usuario logueado, mostramos mensaje y salimos
    if (!isset($_SESSION['ID_USER'])) {
        $this->viewErrores->showMensaje("No se ha iniciado sesión. No puedes cerrar sesión si no hay usuario logueado." );
        return; // importante para que no siga ejecutando el resto
    }

    // Si hay sesión, la cerramos
    session_destroy();

    // Redirigimos a la vista de login con mensaje
    $this->viewAuth->showLogin("SESIÓN CERRADA CON ÉXITO. ¿DESEA INICIAR SESIÓN?");
}

}