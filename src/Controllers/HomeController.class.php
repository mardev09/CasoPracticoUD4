<?php

require_once("src/Core/Controller.php");

// Controlador para la página de inicio
class HomeController extends Controller {
    // Método para mostrar la vista del home y dependiendo de si la sesión está iniciada mantendrá al cliente o lo redireccionará a la vista de login
    public function show() {
        session_start();

        if (!isset($_SESSION['token'])) {
            session_destroy();
            header('Location: /login');
        } else {
            $this->view('HomeView', []);
        }
    }

    public function showCart() {
        session_start();

        if (!isset($_SESSION['token'])) {
            session_destroy();
            header('Location: /login');
        } else {
            if ($_SESSION['shopCart']) {
                $productsModel = $this->model("Productos");
                $shopCart = $_SESSION['shopCart'];
                $products = array();

                foreach($shopCart as $k => $v) {
                    $product = $productsModel->getProductByID($v);
                    $products[] = $product[0];
                }

                $this->view('ShopCartView', $products);
            } else {
                $this->view('ShopCartView', []);
            }
        }
    }

    // Método para las búsquedas de productos
    public function search() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (gettype($_POST['value']) == "string") {
                $productsModel = $this->model("Productos");

                if ($_POST['value']) {
                    $products = $productsModel->getProducts($_POST['value']);
                } else {
                    $products = $productsModel->getAllProducts();
                }

                if ($products) {
                    $this->view('ResultView', $products);
                } else {
                    $products = $productsModel->getAllProducts();
                    $this->view('ResultView', $products);
                }
            }
        }
    }

    // Método para agregar un producto al carrito
    public function addShopCart() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $_POST['id'];
            $index = array_search($id, $_SESSION['shopCart']);

            if ($index === false) {
                $_SESSION['shopCart'][] = $id;
            }

            if (isset($_SESSION['shopCartProdAm'][$id])) {
                $_SESSION['shopCartProdAm'][$id] += 1;
            } else {
                $_SESSION['shopCartProdAm'][$id] = 1;
            }

            echo json_encode(['success' => ($_SESSION['lang'] == 'es') ? "Producto añadido con éxito!" : "Product added successfully"]);
        }
    }

    public function deleteShopCart() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $_POST['id'];

            $productKey = array_search($id, $_SESSION['shopCart']);

            unset($_SESSION['shopCart'][$productKey]);
            unset($_SESSION['shopCartProdAm'][$id]);

            echo json_encode(['success' => ($_SESSION['lang'] == 'es') ? "Producto eliminado con éxito!" : "Product deleted successfully"]);
        }
    }

    public function langChange() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $userModel = $this->model("Usuario");
            
            if (!empty($_POST['lang'])) {
                $userModel->setLang($_POST['lang']);
            }
        }
    }
}
