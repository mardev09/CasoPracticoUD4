<?php

require_once("src/Core/Controller.php");

// Este controlador tendrá todos los métodos relacionados con el panel de administración, es decir, la gestión de productos para los administradores
class AdminController extends Controller {
    public function showProductsAdmin() {
        session_start();

        if (!isset($_SESSION['token'])) {
            session_destroy();
            header('Location: /login');
        } else {
            if ($_SESSION['isAdmin']) {
                $productsModel = $this->model('Productos');
                $products = $productsModel->getAllProducts();
                $this->view('AdminProductsView', $products);
            }
        }
    }

    public function addProduct () {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $productsModel = $this->model('Productos');
            $isAdded = $productsModel->addProduct([
                $_POST['fabricante'],
                $_POST['nombre'],
                $_POST['stock'],
                $_POST['pvp'],
                $_POST['link'],
                $_POST['picture'],
            ]);

            if ($isAdded) {
                echo json_encode(['success' => ($_SESSION['lang'] == 'es') ? 'Producto registrado con éxito!' : 'Product registered successfully!', 'newData' => $productsModel->getProducts($_POST['nombre'])]);
            } else {
                echo json_encode(['error' => ($_SESSION['lang'] == 'es') ? 'Debes de rellenar todos los campos' : 'You need to fill all the fields']);
            }
        }
    }

    public function updateProduct() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $productsModel = $this->model('Productos');
            $isUpdated = $productsModel->updateProduct([
                $_POST['fabricante'],
                $_POST['nombre'],
                $_POST['stock'],
                $_POST['pvp'],
                $_POST['link'],
                $_POST['picture'],
                $_POST['id']
            ]);

            if ($isUpdated) {
                echo json_encode(['success' => ($_SESSION['lang'] == 'es') ? 'Producto actualizado con éxito!' : 'Product updated successfully!', 'newData' => $productsModel->getProductByID($_POST['id'])]);
            } else {
                echo json_encode(['error' => ($_SESSION['lang'] == 'es') ? 'Debes de rellenar todos los campos' : 'You need to fill all fields']);
            }
        }
    }

    public function deleteProduct () {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $productsModel = $this->model('Productos');
            $isDeleted = $productsModel->deleteProduct([$_POST['id']]);

            if ($isDeleted) {
                echo json_encode(['success' => ($_SESSION['lang'] == 'es') ? 'Producto eliminado con éxito!' : 'Product deleted successfully!']);
            } else {
                echo json_encode(['error' => ($_SESSION['lang'] == 'es') ? 'Ha ocurrido un error al eliminar el producto' : 'Error after product delete attempt']);
            }
        }
    }
}
