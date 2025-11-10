<?php
require_once './config.php';
class ModelJuegos
{
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

    public function getJuegos()
    {
        $query = $this->db->prepare('SELECT * FROM juego');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getJuegoByID($id)
    {
        $query = $this->db->prepare('SELECT * FROM juego WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getJuegosByConsola($consola)
    {
        $query = $this->db->prepare("SELECT * FROM juego WHERE id_consola= ?");
        $query->execute([$consola]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }



   
  private function uploadImage($image){
   
        $target = './img/juego/' . uniqid() . "." . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));  
        move_uploaded_file($image['tmp_name'], $target);
        return $target;
    }


    

public function agregarJuego($nombre, $consola, $genero, $descripcion, $imagen = null, $audio = null)
{
    $query = $this->db->prepare("INSERT INTO juego (nombre, id_consola, genero, descripcion, imagen, audio_url) VALUES (?, ?, ?, ?, ?, ?)");
    $nombre1 = strtoupper($nombre);
    $genero1 = strtoupper($genero);
    $params = [$nombre1, $consola, $genero1, $descripcion, null, null];

    if ($imagen)
        $params[4] = $this->uploadImage($imagen); // o como manejes tu imagen
    if ($audio)
        $params[5] = $audio;

     $query->execute($params);
}

    public function eliminarJuego($id)
    {
        $query = $this->db->prepare("DELETE FROM juego WHERE id = ? ");
        $query->execute([$id]);
    }

    public function editarJuego($nombre, $id_consola, $genero, $descripcion, $id_juego, $imagen = null, $audioURL = null)
{
    $nombre1 = strtoupper($nombre);
    $genero1 = strtoupper($genero);

    // -----------------------------
    // Procesar imagen si existe
    // -----------------------------
    $pathImg = null;
    if ($imagen) {
        $pathImg = $this->uploadImage($imagen);
    }

    // -----------------------------
    // Construir consulta dinámica
    // -----------------------------
    $campos = "nombre = ?, id_consola = ?, genero = ?, descripcion = ?";
    $params = [$nombre1, $id_consola, $genero1, $descripcion];

    if ($pathImg !== null) {
        $campos .= ", imagen = ?";
        $params[] = $pathImg;
    }

    if ($audioURL !== null) {
        $campos .= ", audio_url = ?";
        $params[] = $audioURL;
    }

    $params[] = $id_juego;

    $query = $this->db->prepare("UPDATE juego SET $campos WHERE id = ?");
    $query->execute($params);
}

   

   
}

?>