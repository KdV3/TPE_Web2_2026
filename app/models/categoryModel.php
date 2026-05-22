<?php

require_once __DIR__ . '/../models/model.php';

class CategoryModel extends Model{

   public function __construct() {
      Model::__construct();
   }

   public function getCategoryByName($name) {
      $query = $this->db->prepare('SELECT * FROM categoria WHERE nombre = ?');
      $query->execute([$name]);

      return $query->fetch(PDO::FETCH_OBJ);
   }

   public function getProductsByCategory($id) {
      $query = $this->db->prepare('SELECT * FROM productos WHERE id_categoria = ?');
      $query->execute([$id]);
      $products = $query->fetchAll(PDO::FETCH_OBJ);

      return $products;
   }

      public function insertCategory($name) {
      $query = $this->db->prepare('INSERT INTO categoria(nombre) VALUES(?)');
      $query->execute([$name]);

      return $this->db->lastInsertId();
   }
   
   public function editCategory($name, $idCategory){
      $query = $this->db->prepare('UPDATE categoria SET nombre = ? WHERE id_categoria = ? ');
      $query->execute([$name, $idCategory]);
   }

   public function deleteCategory($id) {
      $query = $this->db->prepare('DELETE FROM categoria WHERE id_categoria = ?');
      $query->execute([$id]);
   }

}