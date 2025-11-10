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
    $tables = $query->fetchAll(PDO::FETCH_COLUMN);

    // ---------------- Usuario ----------------
    if (!in_array('usuario', $tables)) {
        $sqlUsuario = "CREATE TABLE usuario (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL,
            passwordd VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB;";
        $this->db->exec($sqlUsuario);

        // Crear usuario por defecto
        $nombreAdmin = 'webadmin';
        $passwordAdmin = password_hash('admin', PASSWORD_DEFAULT);
        $insertAdmin = $this->db->prepare("INSERT INTO usuario (nombre, passwordd) VALUES (?, ?)");
        $insertAdmin->execute([$nombreAdmin, $passwordAdmin]);
    }

    // ---------------- Consola ----------------
    if (!in_array('consola', $tables)) {
        $sqlConsola = "CREATE TABLE consola (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            empresa VARCHAR(100) NOT NULL,
            imagen VARCHAR(255)
        ) ENGINE=InnoDB;";
        $this->db->exec($sqlConsola);
    }

    // ---------------- Juego ----------------
    if (!in_array('juego', $tables)) {
        $sqlJuego = "CREATE TABLE juego (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            genero VARCHAR(100) NOT NULL,
            descripcion TEXT,
            imagen VARCHAR(255),
            audio_url VARCHAR(255),
            id_consola INT,
            FOREIGN KEY (id_consola) REFERENCES consola(id) ON DELETE SET NULL
        ) ENGINE=InnoDB;";
        $this->db->exec($sqlJuego);
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