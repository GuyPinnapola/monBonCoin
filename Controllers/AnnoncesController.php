<?php

namespace Controllers;

use Models\AnnoncesModel;
use Models\CategoriesModel;

class AnnoncesController extends Controller
{
  // Méthode pour afficher les dernières annonces misent en ligne sur la page d'accueil
  public static function accueil()
  {
    $annonces = AnnoncesModel::findAll("date DESC", "LIMIT 2");
    // on utilise la méthode render()
    self::render("annonces/accueil", [
      "title" => "Bienvenue sur mon bon coin",
      "annonces" => $annonces,
      "sousTitre" => "Les dernières annonces misent en ligne"
    ]);
  }

  //Méthode pour afficher le détail d'une annonce
  public static function detail(int $id)
  {
    $annonce = AnnoncesModel::findById([$id]);
    $msg ="";
    if (!$annonce){
      $msg = "Cette annonce n'existe pas";
      
    }

    //On utilise le render()
    self::render("annonces/detail", [
      "title" => "Détail de l'annonce",
      "annonce" => $annonce,
      "msg" =>$msg
    ]);
  }


  //Méthode pour afficher toutes les annonces
  public static function annonces($order = null, $categorie = null){
    if ($categorie == null){
      $annonces = AnnoncesModel::findAll($order);
    }else{
      $annonces = AnnoncesModel::findByIdCat([$categorie], $order);
    }
  

    //Récupération des catégories
    $categories = CategoriesModel::findAll();

    self::render("annonces/annonces", [
    "title" => "Les annonces de monBonCoin",
    "annonces" => $annonces,
    "categories" =>$categories
    
    ]);
  }
}
