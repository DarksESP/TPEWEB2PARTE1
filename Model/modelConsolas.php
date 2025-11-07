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