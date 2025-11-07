<?php

//CONTROLLERS
require_once './Controller/controllerInicio.php';
require_once './Controller/controllerJuegos.php';
require_once './Controller/authController.php';
require_once './Controller/controllerConsola.php';

//ELEMENTOS MIDDLEWARES
require_once './Middlewares/sessionAuthMiddleware.php';
require_once './Middlewares/verifyAuthMiddleware.php';
require_once './libs/response.php';
//////////////////////////////////////////////////////

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'juegos';

// 🔹 Leer la acción de la URL (venga por GET o POST)
$action = $_GET['action'] ?? 'inicio';


$res = new Response();





$params = explode("/", $action);

switch (strtolower($params[0])) {
    case "inicio":
        $controllerInicio = new ControllerInicio();
        $controllerInicio->showInicio();
        break;
    

    //RUTEO JUEGOS
    case "juegos":
        if ((!empty($params[1])) && (is_numeric($params[1]))) {
            $controllerJuegos = new ControllerJuegos();
            $controllerJuegos->showJuego($params[1]);
            break;
        } else {
            $controllerJuegos = new ControllerJuegos();
            $controllerJuegos->showJuegos();
            break;

        }

    case "agregar-juego":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controllerJuegos = new ControllerJuegos();
        $controllerJuegos->showFormAgregar();
        break;
    case "agregar-nuevo-juego":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controllerJuegos = new ControllerJuegos();
        $controllerJuegos->agregarJuego();
        break;

    case "eliminar-juego":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (!empty($params[1]) && is_numeric($params[1])) {
            $controllerJuegos = new ControllerJuegos();
            $controllerJuegos->eliminarJuego($params[1]);
            break;
        } else {
            $controllerJuegos = new ControllerJuegos();
            $controllerJuegos->showJuegos();
            break;
        }
    case "editar-juego":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (!empty($params[1]) && is_numeric($params[1])) {

            $controllerJuegos = new ControllerJuegos();
            $controllerJuegos->showFormEditar($params[1]);
            break;
        } else {
            $controllerJuegos = new ControllerJuegos();
            $controllerJuegos->showJuegos();
            break;
        }
    case "juego-editado":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controllerJuegos = new ControllerJuegos();
        $controllerJuegos->editarJuego();
        break;


    //RUTEO CONSOLA
    case "consolas":
        if (!empty($params[1]) && is_numeric($params[1])) {
            $controllerConsolas = new ControllerConsola();
            $controllerConsolas->showConsola($params[1]);
            break;

        } else {

            $controllerConsolas = new ControllerConsola();
            $controllerConsolas->showConsolas();
            break;
        }
    case "agregar-consola":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controllerConsola = new ControllerConsola();
        $controllerConsola->showFormAgregarConsola();
        break;

    case "agregar-nueva-consola":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controllerConsola = new ControllerConsola();
        $controllerConsola->agregarConsola();
        break;

    case "eliminar-consola":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (!empty($params[1]) && is_numeric($params[1])) {
            $controllerConsola = new ControllerConsola();
            $controllerConsola->eliminarConsola($params[1]);
            break;
        } else {
            $controllerConsola = new ControllerConsola();
            $controllerConsola->showConsolas();
            break;
        }

    case "editar-consola":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (!empty($params[1]) && is_numeric($params[1])) {
            $controllerConsola = new ControllerConsola();
            $controllerConsola->showFormEditarConsola($params[1]);
            break;
        } else {
            $controllerConsola = new ControllerConsola();
            $controllerConsola->showConsolas();
            break;
        }

    case "consola-editada":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ControllerConsola();
        $controller->editarConsola();
        break;



    //RUTEO USUARIO

    case "login":
        $controllerAuth = new AuthController();
        $controllerAuth->showLogin();
        break;

    case "logout":
        $controllerAuth = new AuthController();
        $controllerAuth->showLogOut();
        break;






    default:
        $controllerInicio = new ControllerInicio();
        $controllerInicio->showInicio();
        break;

}

?>