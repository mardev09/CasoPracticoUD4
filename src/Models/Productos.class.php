<?php
require_once("src/Core/DB.php");

// En este haremos algún retoque adicional a los datos de los productos al igual que la búsqueda y obtención de datos de la base de datos
class Productos {
    private $db;

    // En el constructor crearemos el objeto DB 
    public function __construct() {
        $this->db = new DB("localhost", "root", "", "catalogoproductos");
    }

    // Método para obtener los productos
    public function getProducts($val) {
        $valFormatted = "%".$val."%";

        $productos = $this->db->query("SELECT * FROM productos WHERE nombre LIKE ? OR fabricante LIKE ?", [$valFormatted, $valFormatted], true, true);

        return $productos;
    }

    // Método para obtener un producto específicamente por su ID
    public function getProductByID($id) {
        $productos = $this->db->query("SELECT * FROM productos WHERE id = ?", [$id], true, true);

        return $productos;
    }

    // Método par aobtener todos los productos sin condiciones
    public function getAllProducts() {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC", [], true, true);

        return $productos;
    }

    // Método para agregar un producto
    public function addProduct($data) {
        // Si uno de los campos no fué rellenado
        for ($i = 0; $i < COUNT($data); $i++) {
            if (empty($data[$i])) {
                return false;
                break;
            }
        }

        // Insertar los datos del producto
        $this->db->query("
        INSERT INTO productos(fabricante, nombre, stock, pvp, link, picture) 
        VALUES (?, ?, ?, ?, ?, ?)", 
        $data, false, false);

        return true;
    }

    // Método para actualizar un producto
    public function updateProduct($data) {
        // Si uno de los campos no fué rellenado
        for ($i = 0; $i < COUNT($data); $i++) {
            if (empty($data[$i])) {
                return false;
                break;
            }
        }

        // Insertar los datos del producto
        $this->db->query("
        UPDATE productos
        SET fabricante = ?, 
            nombre = ?, 
            stock = ?, 
            pvp = ?, 
            link = ?, 
            picture = ?
        WHERE id = ?;
        ", 
        $data, false, false);

        return true;
    }

    // Método para eliminar un producto
    public function deleteProduct($data) {
        // Eliminar el producto solicitado
        $this->db->query("DELETE FROM productos WHERE id = ?", 
        $data, false, false);

        return true;
    }
}