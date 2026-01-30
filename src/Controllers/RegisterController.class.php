<?php

require_once("src/Core/Controller.php");

class RegisterController extends Controller {
    // Método para mostrar la vista correspondiente
    public function show() {
        $this->view('RegisterView', []);
    }

    // Método para el registro una vez enviados los datos
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['usuario'] && $_POST['password']) {
            $usrModel = $this->model("Usuario");
            $usrModel->addUsuario([$_POST['usuario'], $_POST['password']]);

            echo json_encode(['success' => "Usuario registrado con éxito"]);
        } else {
            echo json_encode(['error' => "Debes introducir todos los datos"]);
        }
    }
}