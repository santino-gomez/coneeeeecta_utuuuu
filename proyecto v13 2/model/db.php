
<?php
class Database {
    public $conn;
    public function __construct() { 

        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "final";

 $this->conn = new mysqli($host, $user, $password, $dbname);

 if ($this->conn->connect_error) {
    throw new Exception('Error de conexión a la BD: ' . $this->conn->connect_error); //En MVC se usa Exception y no DIE
 }

    }
     public function getConection() {
        return $this->conn;
     }
    }
    