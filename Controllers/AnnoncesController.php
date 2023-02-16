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
    $msg = "";
    if (!$annonce) {
      $msg = "Cette annonce n'existe pas";
    }

    //On utilise le render()
    self::render("annonces/detail", [
      "title" => "Détail de l'annonce",
      "annonce" => $annonce,
      "msg" => $msg
    ]);
  }


  //Méthode pour afficher toutes les annonces
  public static function annonces($order = null, $categorie = null)
  {
    if ($categorie == null) {
      $annonces = AnnoncesModel::findAll($order);
    } else {
      $annonces = AnnoncesModel::findByIdCat([$categorie], $order);
    }


    //Récupération des catégories
    $categories = CategoriesModel::findAll();

    self::render("annonces/annonces", [
      "title" => "Les annonces de monBonCoin",
      "annonces" => $annonces,
      "categories" => $categories

    ]);
  }


  //Méthode pour créer une annonce
  public static function annonceAjout()
  {
    // Récupérer les catégories
    $categories = CategoriesModel::findAll();

    // Traitement du formulaire
    $errMsg = "";
    if (
      !empty($_POST["title"]) &&
      !empty($_POST["idCategorie"]) &&
      !empty($_POST["price"]) &&
      !empty($_POST["description"]) &&
      !empty($_FILES["image"])
    ) {
      //Test sur la photo
      var_dump($_FILES);
      if (($_FILES["image"]["size"] < 3000000) &&
        (($_FILES["image"]["type"] == "image/jpeg") ||
          ($_FILES["image"]["type"] == "image/jpg") ||
          ($_FILES["image"]["type"] == "image/png"))
      ) {
        // On sécurise
        $secu = self::security();
        // On renomme la photo
        $photoName = uniqid() . $_FILES["image"]["name"];
        // On copie la photo sur le serveur
        copy($_FILES["image"]["tmp_name"], ROOT . "/public/img/annonces/" . $photoName);
        // On appel la requête d'enregistrement en BDD
        // idUser, idCategorie, title, description, price, image
        $user = $_SESSION["user"]["id"];
        $categorie = (int)$_POST["idCategorie"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $price = (int)$_POST["price"];
        $photoName;
        $newAnnonce = AnnoncesModel::create([$user, $categorie, $title, $description, $price, $photoName]);
        header("Location: " . SITEBASE);
      } else {
        $errMsg = "Image trop lourde ou mauvais format";
      }
    } elseif (!empty($_POST)) {
      $errMsg = "merci de remplir tous les champs";
    }

    self::render("annonces/ajout", [
      "title" => "Nouvelle annonce",
      "categories" => $categories,
      "errMsg" => $errMsg
    ]);
  }

  //Méthode pour modifier une annonce 
  public static function annonceModif($id)
  {
    $errMsg = "";
    //On récupere les catégories
    $categories = CategoriesModel::findAll();
    // On récupere l'annonce à modifier
    $annonce = AnnoncesModel::findById([$id]);
    !$annonce ? header("Location: annonces") : null;
    // Vérifier que l'utilisateur est admin ou que l'utilisateur est le propriétaire de l'annonce
    if ($_SESSION["user"]["role"] == 1 || $_SESSION["user"]["id"] == $annonce["idUser"]) {
      //Traitement de mon formulaire
      if (
        !empty($_POST["title"]) &&
        !empty($_POST["idCategorie"]) &&
        !empty($_POST["price"]) &&
        !empty($_POST["description"]) &&
        !empty($_FILES["image"])
      ) {
        // Controle sur la photo
        if (
          !empty($_FILES["image"]["name"]) && (
            ($_FILES["image"]["size"] < 3000000) &&
            (($_FILES["image"]["type"] == "image/jpeg") ||
              ($_FILES["image"]["type"] == "image/jpg") ||
              ($_FILES["image"]["type"] == "image/png")))
        ) {
          $photoName = uniqid() . $_FILES["image"]["name"];
          copy($_FILES["image"]["tmp_name"], ROOT . "/public/img/annonces/" . $photoName);
        } else {
          $errMsg = "photo trop lourde ou mauvais format";
        }
        //On sécurise
        self::security();
      } elseif (!empty($_POST)) {
        $errMsg = "Merci de remplir tous les champs sauf la photo";
      }
    } else {
      header("Location: annonces");
    }

    self::render("annonces/modif", [
      "title" => "Modification de l'annonce",
      "annonce" => $annonce,
      "categories" => $categories,
      "errMsg" => $errMsg
    ]);
  }
}
