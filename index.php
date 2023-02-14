<?php

use Models\AnnoncesModel;
use Models\CategoriesModel;
use Models\UsersModel;

require_once("autoloader.php");


// Tester la méthode findAll()
// $order = "price DESC";
// $annonces = AnnoncesModel::findAll(null, "LIMIT 2");

// var_dump($annonces);

//Test de la méthode findById()
// $id = [2];
// $annonce = AnnoncesModel::findById($id);

// var_dump($annonce);

//Test de la méthode findByIdUser
// $idUser = [2];
// $annoncesUser = AnnoncesModel::findByUser($idUser);
// var_dump($annoncesUser);

//Test de la méthode findByIdCat()
// $idCategorie = [2];
// $annoncesCat = AnnoncesModel::findByIdCat($idCategorie);
// var_dump($annoncesCat);

//Test de la méthode create
// $data =  [1,2,"tondeuse","maximum 250m², moteur electrique",185,"tondeuse.jpg"];
// // AnnoncesModel::create($data);
// //Commenter sinon création en boucle

// //Test de la méthode Update()
// // $data = [2,"tondeuse","maximum 250m², moteur electrique",185,"tondeuse.jpg", 4];
// AnnoncesModel::update($data);

// //Test de la méthode delete($id)

// $id = [4];
// AnnoncesModel::delete($id);

// Test de la méthode findAll() users
// var_dump(UsersModel::findAll());

// Test de la méthode findById() users
// $id = [2];
// var_dump(UsersModel::findById($id));

//Test de la méthode findByLogin users
// $login = "Guy@gmail.com";
// var_dump(UsersModel::findByLogin([$login]));

// Test de la méthode findBy() users
// $user = ['password' => ['1234']];
// // $user = ['idUser' => [1]];
// var_dump(UsersModel::findBy($user));

// Test de la méthode create()
// $pass = password_hash("1234", PASSWORD_DEFAULT);
// $data = ["test@mail.com", $pass, "test", "nomTest", "66rue de paris", 77140, "nemours"];
// UsersModel::create($data);

//Test de la méthode update() users
// $data = ["Guy@gmail.com", $pass, "Guy", "Pinnapola", "14 avenue de la commune de paris", 94400, "Vitry sur Seine", 2 ];
// UsersModel::update($data);

// $data = ["admin@admin.com", $pass, "admin", "administrateur", "105 rue de rivoli", 75001, "paris", 1];
// UsersModel::update($data);

//Test de la méthode delete
// $id = [4];
// UsersModel::delete($id);

// Test des méthodes de lecture de catégories

var_dump(CategoriesModel::findAll());
echo "<hr>";

var_dump(CategoriesModel::findById([1]));
echo "<hr>";

var_dump(CategoriesModel::findByTitle(["jardin"]));
echo "<hr>";

//Test de la méthode create() categories
// CategoriesModel::create(['jouet']);
// $cat = CategoriesModel::create(['Musique']);
// var_dump($cat);

// Test de la méthode update() categories
// CategoriesModel::update(["instruments de musique", 7]);

//Test de la méthode delete() categories
CategoriesModel::delete([6]);

