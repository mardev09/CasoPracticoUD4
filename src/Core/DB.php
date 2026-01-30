<?php
// Esta clase lo que hace sobre todo es facilitar el trabajo ya que a la hora de hacer peticiones se lleva muchísimo mejor
class DB {
    private $conn;
    // Propiedades estáticas para la comprobación de errores
    static public $connect_error = "";
    static public $error = false;

    // Constructor para realizar la conexión con la base de datos
    public function __construct(private $host, private $username, private $password, private $db) {
        try {
            $this->conn = new PDO("mysql:dbname=".$this->db.";host=".$this->host, $this->username, $this->password);
        } catch (PDOException $e) {
            self::$error = true;
            self::$connect_error = $e->getMessage();
        }
    }

    public function __destruct() {}

    // Método para finalizar la instancia
    public function close() {
        __destruct();
    }

    // Este método es usado por todos los métodos del CRUD para ejecutar la consulta final
    public function query($sql = "", $param = [], bool $fetchAll, bool $fetchAssoc) {
        $query = $this->conn->prepare($sql);

        $query->execute($param);

        // Una vez ejecutada la query preparada obtengo el resultado
        if ($fetchAll) {
            ($fetchAssoc) ? $query = $query->fetchAll(PDO::FETCH_ASSOC): $query = $query->fetchAll();
        } else if ($fetchAssoc) {
            $query = $query->fetch(PDO::FETCH_ASSOC);
        }
        
        return $query;
    }
}