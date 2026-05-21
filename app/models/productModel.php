<?php
require_once __DIR__ . '/../models/model.php';

class ProductModel extends Model {

   public function __construct() {
      Model::__construct();
   }

   public function getAllProducts() {
      $query = $this->db->prepare('SELECT * FROM productos');
      $query->execute();
      $products = $query->fetchAll(PDO::FETCH_OBJ);

      return $products;
   }

   public function getProduct($id) {
      $query = $this->db->prepare('SELECT * FROM productos WHERE id_producto = ?');
      $query->execute([$id]);

      return $query->fetch(PDO::FETCH_OBJ);
   }


   public function getProductsByVendor($name) {
      $query = $this->db->prepare('SELECT * FROM productos WHERE id_vendedor = (SELECT id_vendedor FROM vendedor WHERE nombre = ?)');
      $query->execute([$name]);
      $products = $query->fetchAll(PDO::FETCH_OBJ);

      return $products;
   }

   public function getVendorByName($name) {
      $query = $this->db->prepare('SELECT * FROM vendedor WHERE nombre = ?');
      $query->execute([$name]);

      return $query->fetch(PDO::FETCH_OBJ);
   }


   public function insertProduct($name, $description, $idCategory, $price, $disscount, $productOwner, $img) {
      $query = $this->db->prepare('INSERT INTO productos(nombre, descripcion, id_categoria, precio, descuento, id_vendedor, direccion_img) VALUES(?,?,?,?,?,?,?)');
      $query->execute([$name, $description, $idCategory, $price, $disscount, $productOwner, $img]);

      return $this->db->lastInsertId();
   }


   public function editProduct($name, $description, $idCategory, $price, $disscount, $productOwner){
      $query = $this->db->prepare('UPDATE productos SET nombre = ?, descripcion = ?, id_categoria = ?, precio = ?, descuento = ? WHERE id_producto = ? ');
      $query->execute([$name, $description, $idCategory, $price, $disscount, $productOwner]);
   }


   public function deleteProduct($id) {
      $query = $this->db->prepare('DELETE FROM productos WHERE id_producto = ?');
      $query->execute([$id]);
   }


}