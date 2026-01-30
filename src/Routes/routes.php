<?php
// Incluímos a la clase del enrutador
require_once("Router.php");

$router = new Router(); // Lo creamos

// Y definimos todas las rutas con el tipo de petición que les corresponde y además su respectivo controlador
$router->add('GET', '/inicio', 'HomeController@show');
$router->add('GET', '/show-cart', 'HomeController@showCart');
$router->add('POST', '/search', 'HomeController@search');
$router->add('GET', '/productos', 'HomeController@productos');
$router->add('GET', '/login', 'LoginController@show');
$router->add('POST', '/login-submit', 'LoginController@login');
$router->add('GET', '/logout', 'LoginController@logout');
$router->add('GET', '/register', 'RegisterController@show');
$router->add('POST', '/register-submit', 'RegisterController@register');
$router->add('GET', '/admin-manage', 'AdminController@showProductsAdmin');
$router->add('POST', '/add-product', 'AdminController@addProduct');
$router->add('POST', '/update-product', 'AdminController@updateProduct');
$router->add('POST', '/delete-product', 'AdminController@deleteProduct');
$router->add('POST', '/add-shopcart', 'HomeController@addShopCart');
$router->add('POST', '/delete-shopcart', 'HomeController@deleteShopCart');
$router->add('POST', '/lang-change', 'HomeController@langChange');

$router->handler(); // Finalmente, el handler en base la solicitud realizada, se encangargará de redireccionarnos al lugar correspondiente