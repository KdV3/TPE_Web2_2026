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
            $sql = file_get_contents('././db/db_tienda_electronica.sql');
     
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
 
