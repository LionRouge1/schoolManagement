<?php
session_start();
require_once 'config.php';




if (isset($_POST['password']) and isset($_POST['2password'])) {
  $password = htmlspecialchars($_POST['password']);
  $password_retype = htmlspecialchars($_POST['2password']);

  if (isset($_POST['email']) and $_POST['email'] !== $_SESSION['email']) {

    $admin = $bdd->prepare('SELECT * FROM administrator WHERE adminEmail = ?');
    $admin->execute(array($email));
    $dataAdmin = $admin->fetch();
    $rowAdmin = $admin->rowCount();
  
    if ($rowAdmin == 0) {
      $email = htmlspecialchars($_POST['email']);
      $adminup = $bdd->prepare('UPDATE administrator SET adminEmail=? WHERE admin_id=1');
      $adminup->execute(array($email));
    } else {
      echo '<div class="alert alert-danger"><strong>Error!! </strong>Existing account</div>';
      return;
    }
  }
  
  if ($password == $password_retype && !empty($_POST['password'])) {

    $adminup = $bdd->prepare('UPDATE administrator SET adminPwd=? WHERE admin_id=1');
    $adminup->execute(array($password));
    header('Location: deconnexion.php');
    die();
  } else {
    echo '<div class="alert alert-danger"><strong>Error!! </strong> Different password</div>';
    return;
  }
  header('Location: deconnexion.php');
  die();
}
