<?php

namespace Controllers;

use Models\UsersModel;

class UsersController extends Controller
{
  //Création d'un nouvel utilisateur

  public static function inscription(){
    //Traitement du formulaire
    $errMsg ="";
    // Regex du mot de passe (juste minimum 8 caractères)
    $pattern = '/^.{8,}$/';
    if (!empty($_POST) &&
      !empty($_POST["login"]) &&
      !empty($_POST["firstName"]) &&
      !empty($_POST["lastName"]) &&
      !empty($_POST["address"]) &&
      !empty($_POST["cp"]) &&
      !empty($_POST["city"]) &&
      ($_POST["password"] == $_POST["confirm"])
    ) {

      if(!filter_var($_POST["login"], FILTER_VALIDATE_EMAIL )){
        $errMsg = "Merci de saisir un email valide<br>";
      }
      if(!preg_match($pattern, $_POST["password"])){
        $errMsg .= "Merci de saisir un mot de passe correct";
      }
      if(!$errMsg){
        // Tout est ok
        $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
        //On vérifie que l'email ne soit pas déjà en BDD
        $login = [$_POST["login"]];
        $testLogin = UsersModel::findByLogin($login);
        if($testLogin){
          $errMsg = "Vous avez déjà un compte";
        }else{
          // on enregistre en BDD
          //On sécurise les données
          self::security();
          $data = [$_POST["login"],
            $pass,
            $_POST["firstName"],
            $_POST["lastName"],
            $_POST["address"],
            $_POST["cp"],
            $_POST["city"]];
          UsersModel::create($data);
          $_SESSION["message"] = "Votre compte est crée, vous pouvez vous connecter";
          header("Location: " . SITEBASE);
        }
      }
      
    }elseif (!empty ($_POST)) {
      $errMsg = "Merci de remplir tous les champs du formulaire et d evérifier que vos mots de passe concordent";
    }
    self::render("users/inscription", [
      "title" => "Inscription",
      "errMsg" => $errMsg
    ]);
  }
}
