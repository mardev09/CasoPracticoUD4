<?php

require_once("src/Core/Controller.php");

class LoginController extends Controller {

    // Método para mostrar la vista
    public function show() {
        $this->view('LoginView', []);
    }

    // Método para usar una vez recibidos los datos de inicio de sesión
    public function login() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['usuario'] && $_POST['password']) {
            $usrModel = $this->model("Usuario");
            $usr = $usrModel->getUsuario($_POST['usuario']);
            if ($usr) {
                $isAuth = $usrModel->verifyPassword($_POST['password'], $usr['passwd']);
            } else {
                $isAuth = false;
            }
            

            if ($isAuth) {
                $_SESSION['token'] = password_hash(session_id(), PASSWORD_DEFAULT);
                $_SESSION['user'] = $usr['usuario'];
                $_SESSION['isAdmin'] = ($usr['isAdmin']) ? true : false;
                $_SESSION['shopCart'] = array();
                $_SESSION['shopCartProdAm'] = array();
                $_SESSION['lang'] = 'es';
                echo json_encode(['auth' => true,'token' => $_SESSION['token']]);
            } else {
                echo json_encode(['error' => "El usuario y/o contraseña son incorrectos"]);
            }
        } else {
            echo json_encode(['error' => "Debes introducir todos los datos"]);
        }
    }

    // Método para el cierre de sesión
    public function logout() {
        session_start();

        if ($_SESSION['token']) {
            $_SESSION = array();
            session_destroy();
        } else {
            header('Location: login');
        }
    }
}