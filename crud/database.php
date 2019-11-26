<?php
    /**
     * Autor: Carlos Clemente
     * Correo: cclemente1998@gmail.com
     */
    class Database{
        private $con;
        private $dbhost = "localhost:3306";
        private $dbuser = "root";
        private $dbpass = "root";
        private $dbname = "SistemasDistribuidos";

        function __construct(){
            $this->connect_db();
        }

        public function connect_db(){
            $this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
            if(mysqli_connect_error()){
                die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
            }
        }

        public function sanitize($var){
            $return = mysqli_real_escape_string($this->con, $var);
            return $return;
        }

        public function create($nombre, $cantidad){
            $sql = "INSERT INTO articulos (articulo, cantidad) VALUES ('$nombre', $cantidad)";
            $res = mysqli_query($this->con, $sql);
            if ($res) {
                return true;
            } else {
                return false;
            }
        }

        public function read($id){
            if ($id != 0) {
                $sql = "SELECT * FROM articulos WHERE id = $id";
            } else {
                $sql = "SELECT * FROM articulos";
            }

            $res = mysqli_query($this->con, $sql);
            return $res;
        }
    }
?>
