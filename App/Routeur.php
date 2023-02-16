<?php

namespace App;


use Controllers\UsersController;
use Controllers\AnnoncesController;

class Routeur
{
  public function app()
  {
    // On test le routeur
    // echo "le routeur fonctionne";
    // echo "<br>";

    // Récupérer l'url
    $request = $_SERVER["REQUEST_URI"];
    // echo $request; 
    // On supprime "/monBonCoin/public" de $request
    $nb = strlen(SITEBASE);
    $request = substr($request, $nb);
    // echo "<hr>";
    // echo $request; 
    //On casse $request pour récupérer uniquement la route demandé et pas les param GET
    $request = explode("?", $request);
    $request = $request[0];
    // echo $request;

    // On définit les routes du projet
    switch ($request) {
      case "":
        // echo "vous êtes sur la page d'accueil";
        $accueil = AnnoncesController::accueil();
        break;
      case "toto":
        echo "voues êtes sur la page TOTO";
        break;
      case "annonces":
        // echo "vous êtes sur la page des annonces";
        if (isset($_GET["order"]) && isset($_GET["idCategorie"])){
          $order = $_GET["order"];
          $categorie = $_GET["idCategorie"];
          AnnoncesController::annonces($order, $categorie);
        }
        AnnoncesController::annonces();
        break;
      case "annonceDetail":
        // echo "vous êtes sur la page détail de l'annonce";
        if (isset($_GET["id"])){
          $id = (int)$_GET["id"];
          AnnoncesController::detail($id);
        }
        
        break;
      case "annonceAjout":
        // echo "vous êtes sur la page création d'annonce";
        $newAnnonce = AnnoncesController::annonceAjout();
        break;
      case "annonceModif":
        echo "vous êtes sur la page modification d'annonce";
        break;
      case "annonceSupp":
        echo "vous êtes sur la page suppression d'annonce";
        break;
      case "panier":
        echo "vous êtes sur la page du panier";
        break;
      case "inscription":
        // echo "vous êtes sur la page d'inscription";
        $inscription = UsersController::inscription();
        break;
      case "connexion":
        // echo "vous êtes sur la page de connexion";
        $connexion = UsersController::connexion();
        break;
      case "deconnexion":
        // echo "vous êtes sur la page de deconnexion";
        unset($_SESSION["user"]);
        header("Location: " . SITEBASE);
        break;
      case "profil":
        echo "vous êtes sur la page du profil";
        break;
      default:
        echo "cette page n'existe pas";
        break;
    }
  }
}
