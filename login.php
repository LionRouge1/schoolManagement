<?php
session_start();
require_once 'config.php';

$who = $_SESSION['who'];


if (isset($_GET['login_err'])) {
  $err = htmlspecialchars($_GET['login_err']);
  switch ($err) {
    case 'password':
?>
      <div class="alert alert-danger">
        <strong>Error</strong> incorrect password
      </div>
    <?php
      break;
    case 'email':
    ?>
      <div class="alert alert-danger">
        <strong>Error</strong> incorrect email
      </div>
    <?php
      break;
    case 'already':
    ?>
      <div class="alert alert-danger">
        <strong>Error</strong> non-existent account
      </div>
    <?php
      break;
    case 'passwordAdmin':
    ?>
      <div class="alert alert-danger">
        <strong>Error</strong> mot de passe administrateur incorrect
      </div>
<?php
      break;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>Document</title>
</head>

<body>
  
  <div class="container-sm p-5" style="width: 60%;">

  <?php  
  switch($who) {
    case 'users' : 
      ?>
      <p class="btn btn-outline-dark">Welcome to users page</p>
      <?php
      break;
    case 'admin' :
      $admin = true;
      ?>
      <p class="btn btn-outline-dark">Welcome to the admin page</p>
      <?php
      break;
    case 'teachers' :
      ?>
      <p class="btn btn-outline-dark">Welcome to teachers page</p>
      <?php

      break;
  }?>
    <form action="connexion.php" method="post" class="border shadow rounded p-5 was-validated">
      <div class="mb-3 mt-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" autocomplete="off" require>
        <div class="invalid-feedback">Please enter a valid mail.</div>
      </div>
      <div class="mb-3">
        <label for="pwd" class="form-label">Password:</label>
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" autocomplete="off" require>
        <div class="invalid-feedback">Please fill out this field.</div>
      </div>
      <div class="form-check mb-3">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="remember"> Remember me
        </label>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <?php if(!isset($admin)):?> <a href="registe.php" class="btn btn-primary">Register</a><?php endif;?>
    </form>
    <a href="deconnexion.php" class="btn btn-secondary">
      <- Go back</a>
  </div>
</body>

</html>