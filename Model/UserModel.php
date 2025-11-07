<?php
require_once './config.php';
class UserModel {

    protected $db;
    public function __construct()

    {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8",
            MYSQL_USER,
            MYSQL_PASS
        );
        $this->_deploy();
    }
    private function _deploy()
    {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
        CREATE TABLE usuario (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL
        );

        CREATE TABLE consola (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL
        );

        CREATE TABLE juego (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            id_consola INT,
            FOREIGN KEY (id_consola) REFERENCES consola(id)
        );
        END;

            $this->db->exec($sql);
        }
    }
    
  public function tieneUsuarioDB($userName) {
    $query = $this->db->prepare("SELECT nombre FROM usuario WHERE nombre =?");
     $query->execute([$userName]);
    $userN = $query->fetch(PDO::FETCH_OBJ);
    return $userN;
  }
    
  
    public function getUserByNombre($userName) {    
        $query = $this->db->prepare("SELECT * FROM usuario WHERE nombre = ?");
        $query->execute([$userName]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }

     public function getUsuarioByEmail($email)
    {
        $query = $this->db->prepare("SELECT * FROM usuario WHERE email = ?");
        $query->execute([$email]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function registrarUsuario($email, $password)
    {
        if (!empty($this->getUsuarioByEmail($email))) {
            $query = $this->db->prepare("INSERT INTO usuario ($email, $password) VALUES (?,?)");
            $query->execute([$email, $password]);


        } else {
            echo "Acceso denegado";
        }



    }
}