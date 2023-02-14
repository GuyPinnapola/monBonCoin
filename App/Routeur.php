<?php

namespace App;

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
        echo "vous êtes sur la page d'accueil";
        break;
      case "toto":
        echo "voues êtes sur la page TOTO";
        break;
      case "annonce":
        echo "vous êtes sur la page des annonces";
        break;
      case "annonceDetail":
        echo "vous êtes sur la page détail de l'annonce";
        break;
      case "annonceAjout":
        echo "vous êtes sur la page création d'annonce";
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
        echo "vous êtes sur la page d'inscription";
        break;
      case "connexion":
        echo "vous êtes sur la page de connexion";
        break;
      case "deconnexion":
        echo "vous êtes sur la page de deconnexion";
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
