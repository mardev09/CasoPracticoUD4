<?php

class Router
{
    protected $routes = []; // Esta matriz tendrá todas las peticiones en GET y POST, es decir, dos arrays asociativos dentro de esta

    // Añadimos las rutas a la propiedad routes según el tipo de petición
    public function add($method, $url, $action) 
    {
        $this->routes[$method][$url] = $action;
    }

    // Handler para las peticiones
    public function handler() 
    {
        $requestUrl = $_SERVER['REQUEST_URI']; // Obtenemos la url
        $requestMethod = $_SERVER['REQUEST_METHOD']; // Obtenemos el método de petición

        // Formateo de la URL, simplemente para dejar las url lista y en el formato en el que se encuentran las establecidas en las rutas
        $url = explode('/', $requestUrl);
        $url = array_slice($url, 1);
        $requestUrl = '/' . implode('/', $url);

        $requestUrl = strtok($requestUrl, '?');

        if (isset($this->routes[$requestMethod][$requestUrl])) { // Si ambos componentes coinciden con una de las rutas definidas y que se encuentra dentro de la propiedad $routes
            list($controllerName, $methodName) = explode('@', $this->routes[$requestMethod][$requestUrl]); // Con esto logramos definir a la vez dos variables y asignarles los dos valores usando la función explode, en este caso el separador sería el @
            require_once("src/Controllers/$controllerName.class.php"); // Requerimos el controlador específico
            $controller = new $controllerName(); // Creamos dicho objeto

            return $controller->$methodName(); // Y llamamos al método correspondiente
        }

        header("Location: /inicio"); // Si no se encuentra nada, entonces nos redireccionará al inicio
    }
}