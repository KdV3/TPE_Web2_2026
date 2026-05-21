<?php

require_once __DIR__ . '/../models/model.php';

class UsersModel extends Model{

   public function __construct() {
      Model::__construct();
   }

   public function getAll() {
      $query = $this->db->prepare('SELECT * FROM vendedor');
      $query->execute();
      $users = $query->fetchAll(PDO::FETCH_OBJ);

      return $users;
   }

   public function register($name,$email,$adress,$phoneNumber,$information,$logo,$password){
      $query = $this->db->prepare('INSERT INTO vendedor(nombre,email,direccion,tel_contacto,informacion,img_logo,contrasenia) VALUES (?,?,?,?,?,?,?)');
      $query->execute([$name,$email,$adress,$phoneNumber,$information,$logo,$password]);

      return $this->db->lastInsertId();
   }

   public function get($id) {
      $query = $this->db->prepare('SELECT * FROM vendedor WHERE id = ?');
      $query->execute([$id]);

      return $query->fetch(PDO::FETCH_OBJ);
   }

   public function getByEmail($email) {
      $query = $this->db->prepare('SELECT * FROM vendedor WHERE email = ?');
      $query->execute([$email]);

      return $query->fetch(PDO::FETCH_OBJ);
   }

   public function editProfile($name, $email, $adress, $phoneNumber, $info, $id){
      $query = $this->db->prepare('UPDATE vendedor SET nombre = ?, email = ?, direccion = ?, tel_contacto = ?, informacion = ? WHERE id_vendedor = ? ');
      $query->execute([$name,$email,$adress,$phoneNumber,$info, $id]);
      
      return $this->db->lastInsertId();
   }
}
