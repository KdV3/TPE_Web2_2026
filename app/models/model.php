<?php 
    require_once  '././config.php';

    class Model {
    protected $db;

    public function __construct() {
        $this->db = new PDO(
        "mysql:host=".MYSQL_HOST .
        ";dbname=".MYSQL_DB.";charset=utf8", 
        MYSQL_USER, MYSQL_PASS);
        $this->_deploy();
    }

    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql = "CREATE TABLE `categoria` (
            `id_categoria` int(11) NOT NULL,
            `nombre` varchar(25) NOT NULL);

            CREATE TABLE `productos` (
            `id_producto` int(11) NOT NULL,
            `nombre` varchar(80) NOT NULL,
            `descripcion` text NOT NULL,
            `id_categoria` int(11) NOT NULL,
            `precio` double NOT NULL,
            `descuento` int(3) NOT NULL,
            `fecha_publicacion` date NOT NULL DEFAULT current_timestamp(),
            `id_vendedor` int(11) NOT NULL,
            `direccion_img` varchar(150) DEFAULT NULL);

            CREATE TABLE `vendedor` (
            `id_vendedor` int(11) NOT NULL,
            `nombre` varchar(50) NOT NULL,
            `email` varchar(60) NOT NULL,
            `direccion` varchar(50) NOT NULL,
            `tel_contacto` varchar(25) NOT NULL,
            `informacion` text NOT NULL,
            `img_logo` varchar(100) DEFAULT NULL,
            `contrasenia` varchar(70) NOT NULL
            )
            ";
            $this->db->query($sql);
        }
    }

    public function getAllCategories() {
      $query = $this->db->prepare('SELECT * FROM categoria');
      $query->execute();
      $categories = $query->fetchAll(PDO::FETCH_OBJ);

      return $categories;
   }

    public function getAllVendors() {
      $query = $this->db->prepare('SELECT * FROM vendedor');
      $query->execute();
      $vendors = $query->fetchAll(PDO::FETCH_OBJ);

     return $vendors;
   }
}
?>
 
