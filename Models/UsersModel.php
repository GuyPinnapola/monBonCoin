<?php

namespace Models;

use PDO;
use App\Db;

class UsersModel extends Db{
  //////////////////// CRUD \\\\\\\\\\\\\\\\\\\\\\\\\\

  /////////////////// Méthode de lecture \\\\\\\\\\\\\\\\\\\\

  // Trouver tous les utilisateurs 
  public static function findAll(){
    $request = "SELECT * FROM users";
    $response = self::getDb()->prepare($request);
    $response->execute();

    return $response->fetchAll(PDO::FETCH_ASSOC);
  }



  //Trouver un utilisateur par son id
  /**
   * Attend un id utilisateur
   * @param array $id[int]
   */
  // public static function findById(array $id){
  //   $request = "SELECT * FROM annonces WHERE idAnnonce = ?";
  //   $response = self::getDb()->prepare($request);
  //   $response->execute($id);

  //   return $response->fetch(PDO::FETCH_ASSOC);
  // }


  //Trouver un utilisateur par son login
  /**
   * Attend un login utilisateur
   * @param array $login[string]
   */
  public static function findByLogin(array $login){
    $request = "SELECT * FROM users WHERE login = ?";
    $response = self::getDb()->prepare($request);
    $response->execute($login);

    return $response->fetch(PDO::FETCH_ASSOC);
  }

  //Trouver un utilisateur
//   public static function findByIdOrLogin(array $data){
//     if(is_int($data[0])){
//         $request = "SELECT * FROM users WHERE idUser = ?";
//     }else{
//         $request = "SELECT * FROM users WHERE login = ?";
//     }
//     $response = self::getDb()->prepare($request);
//     $response->execute($data);

//     return $response->fetch(PDO::FETCH_ASSOC);
// }

  //Trouver un utilisateur par son login ou son id
  /**
   * Cette méthode permet de trouver un ou des utilisateurs par n'importe quel critere
   * elle attend un tableau associatif
   * @param array $user["clé" => ["valeur"]];
   */
  public static function findBy(array $user){
    $request = "SELECT * FROM users WHERE " . key($user) ."= ?";
    $response = self::getDb()->prepare($request);
    $response->execute(current($user));

    return $response->fetchAll(PDO::FETCH_ASSOC);
  }

  ////////////////// Méthode d'écriture \\\\\\\\\\\\\\\\\

  // Créer un nouvel utilisateur
  //Méthode de création d'une annonce
  public static function create(array $data){
    // $data est un tableau qui contient les valeurs à inserer en BDD
    
    $request = "INSERT INTO users (login, password, firstName, lastName, address, cp, city) VALUES (?, ?, ?, ?, ?, ?, ?) ";
    $response = self::getDb()->prepare($request);
    $response->execute($data);
  }
  
  // Modification d'un utilisateur
  public static function update(array $data){
    $request = "UPDATE users SET login = ?, password = ?, firstName = ?, lastName = ?, address = ?, cp = ?, city = ? WHERE idUser = ?";
    $response = self::getDb()->prepare($request);
    $response->execute($data);
  }
  
  ////////////////////////////////// Méthode de suppresion \\\\\\\\\\\\\\\\\\\
  public static function delete(array $id){
    $request = "DELETE FROM users WHERE idUser = ?";
    $response = self::getDb()->prepare($request);
    return $response->execute($id);
    
  }





}