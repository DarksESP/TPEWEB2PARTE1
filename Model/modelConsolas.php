<?php
require_once './config.php';

class modelConsolas {

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




        public function getConsolas()
    {
        $query = $this->db->prepare('SELECT * FROM consola');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getConsolaByID($id) {
        $query = $this->db->prepare("SELECT * FROM consola WHERE id =?");
        $query->execute ([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
 private function uploadImage($image){
   
        $target = './img/juego/' . uniqid() . "." . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));  
        move_uploaded_file($image['tmp_name'], $target);
        return $target;
    }
   public function agregarConsola($nombre, $empresa, $imagen = null)
    {
         $pathImg = null;
        if ($imagen) {
            $pathImg = $this->uploadImage($imagen);

        }
        $nombre1 = strtoupper($nombre);
        $empresa1 = strtoupper($empresa);
        $query = $this->db->prepare("INSERT INTO consola (nombre, empresa, imagen) VALUES (?,?,?)");
        $query->execute ([$nombre1, $empresa1, $pathImg]);




    }


 public function eliminarConsolaByID($id)
    {
        $query = $this->db->prepare("DELETE FROM consola WHERE id = ? ");
        $query->execute([$id]);
    }




  public function editarConsola($nombre, $empresa, $id_consola, $imagen = null)
    {
         $pathImg = null;
        if ($imagen) {
            $pathImg = $this->uploadImage($imagen);
            $query = $this->db->prepare("UPDATE consola SET nombre = ?, empresa =?,  imagen =?  WHERE id = ?");
            $nombre1 = strtoupper($nombre);
             $empresa1 = strtoupper($empresa);
            $query->execute([$nombre1, $empresa1, $pathImg, $id_consola]);

        }

        else {
            $query= $this->db->prepare("UPDATE consola SET nombre=? , empresa= ?   WHERE id =?");
             $nombre1 = strtoupper($nombre);
              $empresa1 = strtoupper($empresa);
            $query->execute([$nombre1,$empresa1, $id_consola]);

        }
    }

   
}
?>