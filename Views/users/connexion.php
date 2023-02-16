<?php 
// var_dump($_POST);
if (isset($_SESSION["message"])){
  $message = $_SESSION["message"];
  unset($_SESSION["message"]);

  echo '<div class="alert alert-dismissible alert-warning">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading"></h4>
  <p class="mb-0">'. $message . '</p>
</div>';
  
}
?>


<div class="container">
  <?php if($errMsg) : ?>
    <div class="alert alert-dismissible alert-warning">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading"></h4>
  <p class="mb-0"><?= $errMsg  ?></p>
</div>
  <?php endif ?>
  <form method="POST">
    <div class="row justify-content-arround">

      <label for="login">Email</label>
      <input type="text" name="login" id="login" placeholder="Votre email" class="form-control">

      <label for="password">Mot de passe</label>
      <input type="password" name="password" id="password" placeholder="Votre mot de passe" class="form-control">
      <small id="passwordHelp" class="form-text text-muted">Votre mot de passe doit contenir 8 caractères minimum</small>

    </div>
    <button class="btn btn-secondary w-100 m-5">Connexion</button>
  </form>
  <div class="text-center">Pas encore de compte ? <a href="inscription">S'inscrire</a></div>
</div>