<?php
namespace App;

use Controllers\AnnoncesController;
use Controllers\Controller;
use Controllers\UsersController;

class Routeur{
    public function app(){
        // On test le routeur
        // echo "le routeur fonctionne";

        // Récupérer l'url
        $request = $_SERVER['REQUEST_URI'];
        // echo $request;
        // On supprime "/monboncoin/public" de $request
        $nb = strlen(SITEBASE);
        $request = substr($request, $nb);
        // echo "<hr>";
        // echo $request;
        // On casse $request pour récupérer uniquement la route demandé et pas les aram GET
        $request = explode("?", $request);
        $request = $request[0];
        // echo $request;

        // On définit les routes du projet
        switch ($request){
            case '':
                // echo "vous etes sur la page d'accueil";
                AnnoncesController::accueil();
                break;
            case 'annonces':
                // echo "vous etes sur la page annonces";
                if (isset($_GET['order']) && isset($_GET['idCategorie'])) {
                  $order = $_GET['order'];
                  $categorie = $_GET['idCategorie'];
                  AnnoncesController::annonces($order, $categorie);
                }
                AnnoncesController::annonces();
                break;
            case 'annonceDetail':
                // echo "vous etes sur la page détail de l'annonce";
                if (isset($_GET['id'])) {
                    $id = (int)$_GET['id'];
                    AnnoncesController::detail($id);
                }
                break;
            case 'annonceAjout':
                // echo "page création d'annonce";
                $newAnnonce = AnnoncesController::annonceAjout();
                break;
            case 'annonceModif':
                // echo "page modification d'annonce";
                if (isset($_SESSION['user'])) {
                    $id = (int)$_GET['id'];
                    $updateAnnonce = AnnoncesController::annonceModif($id);
                }else{
                    header('Location: connexion');
                }
                
                break;
            case 'annonceSupp':
                // echo "page de suppression d'annonce";
                if (isset($_SESSION['user'])) {
                  $id = [(int)$_GET["id"]];
                $annonceSup = AnnoncesController::annonceSupp($id);
                }else{
                  header("Location: connexion");
                }
                break;
            case "supprimer":
              if (isset($_SESSION['user'])) {
                $id = [(int)$_GET["id"]];
                AnnoncesController::confirmSupp($id);
              }
              break;
            case 'panier':
                echo "page panier";
                break;
            case 'inscription':
                // echo "page d'inscription";
                $inscription = UsersController::inscription();
                break;
            case 'connexion':
                // echo "page de connexion";
                $connexion = UsersController::connexion();
                break;
            case 'deconnexion':
                // echo "page de deconnexion";
                unset($_SESSION['user']);
                header('Location: ' . SITEBASE);
                break;
            case 'profil':
                // echo "page de profil";
                if (isset($_SESSION['user'])) {
                    $profil = UsersController::profil();
                }else{
                    header('Location: connexion');
                }
                break;
            default:
                echo "cette page n'existe pas";
                break;
        }
    }
}