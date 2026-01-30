<?php
// Esta clase en la clase padre de todos los controladores, es decir, tiene los dos métodos sumamente necesarios
class Controller
{   
    // Para llamar a la vista
    public function view($view, $data = [])
    {
        $usuarioModel = $this->model("Usuario");
        $t = $usuarioModel->loadTexts();
        
        extract($data);
        
        require_once("src/Views/$view.php");
    }

    // Para llamar al modelo si se precisa
    public function model($model)
    {
        require_once("src/Models/$model.class.php");
        return new $model();
    }
}