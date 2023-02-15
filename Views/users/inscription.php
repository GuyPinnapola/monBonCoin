<?php 
// var_dump($_POST);
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


      <label for="firstName">Prénom</label>
      <input type="text" name="firstName" id="firstName" placeholder="Votre Prénom" class="form-control">

      <label for="lastName">Nom</label>
      <input type="text" name="lastName" id="lastName" placeholder="Votre Nom" class="form-control">

      <label for="address">Address</label>
      <input type="text" name="address" id="address" placeholder="Votre Adresse" class="form-control">

      <label for="cp">Code Postal</label>
      <input type="text" name="cp" id="cp" placeholder="Votre Code Postal" class="form-control">

      <label for="city">Ville</label>
      <input type="text" name="city" id="city" placeholder="Votre Ville" class="form-control">

      <label for="password">Mot de passe</label>
      <input type="password" name="password" id="password" placeholder="Votre mot de passe" class="form-control">
      <small id="passwordHelp" class="form-text text-muted">Votre mot de passe doit contenir 8 caractères minimum</small>

      <label for="confirm">Confirmation du mot de passe</label>
      <input type="password" name="confirm" id="confirm" placeholder="Confirmer votre mot de passe" class="form-control">



    </div>
    <button class="btn btn-secondary w-100">S'inscrire</button>
  </form>
</div>