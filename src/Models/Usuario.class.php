<?php
require_once("src/Core/DB.php");

class Usuario {
    private $db;

    // En el constructor crearemos el objeto DB 
    public function __construct() {
        $this->db = new DB("localhost", "root", "", "catalogoproductos");
    }

    // Método para obtener los datos de un usuario en concreto
    public function getUsuario($user) {
        $user = $this->db->query("SELECT * FROM usuario WHERE usuario = ?", [$user], false, true);

        return $user;
    }

    // Método para verificar que una contraseña coincide con el hash registrado en la base datos
    public function verifyPassword($passwdSent, $registeredPasswd) {
        $isValid = password_verify($passwdSent, $registeredPasswd);

        return $isValid;
    }

    // Método para comprobar que un usuario es un administrador
    public function isAdmin($user) {
        $admin = $this->db->query("SELECT isAdmin FROM usuario WHERE usuario = ?", [$user], false, true);

        if ($admin['isAdmin']) return true;
        
        return false;
    }

    // Método para crear un usuario
    public function addUsuario($data = []) {
        $data[1] = password_hash($data[1], PASSWORD_BCRYPT);

        $this->db->query("INSERT INTO usuario(usuario, passwd) VALUES (?, ?)", $data, false, false);
    }

    // Lang
    public function setLang($lang) {
        $_SESSION['lang'] = $lang;
    }

    public function getLang() {
        return $_SESSION['lang'] ?? 'es';
    }

    public function loadTexts() {
        $lang = $this->getLang();
        return require "src/Templates/$lang.php";
    }
}