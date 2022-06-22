<?php

use LDAP\Result;

session_start();
ob_start();
if (!isset($_SESSION['id'])) {
  header('Location: ../deconnexion.php');
  die();
}

require_once '../config.php';
$who = $_SESSION['who'];
$id = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE user_id =?";
$result = $bdd->prepare($sql);
$result->execute(array($id));
$rech = $result->fetch();

  $email = $rech['userEmail'];
  $name = $rech['userName'];
  $surname = $rech['userSurname'];
  $password = $rech['userPwd'];
  $contact = $rech['userContact'];
  $address = $rech['userAddress'];

  function updateValue($bdd, $sql, $n, $message){
    $id = $_SESSION['id'];
    $resul = $bdd->prepare($sql);
    $resul->execute(array($n, $id));
    print $message;
  };

if (isset($_POST['name']) and $_POST['name'] !== $name) {
  $n = $_POST['name'];
  $sql = "UPDATE users SET userName=? WHERE user_id=?";
  $message = "name updated successfully \n";
  updateValue($bdd, $sql, $n, $message);
}

if (isset($_POST['surname']) and $_POST['surname'] !== $surname) {
  $n = $_POST['surname'];
  $sql = "UPDATE users SET userSurname =? WHERE user_id =?";
  $message = "Surnmae updated successfully \n";
  updateValue($bdd, $sql, $n, $message);
}

if (isset($_POST['contact']) and $_POST['contact'] !== $contact) {
  $n = $_POST['contact'];
  $sql = "UPDATE users SET userContact=? WHERE user_id= ?";
  $message = "Contact updated successfully \n";
  updateValue($bdd, $sql, $n, $message);
}

if (isset($_POST['address']) and $_POST['address'] !== $address) {
  $n = $_POST['address'];
  $sql = "UPDATE users SET userAddress =? WHERE user_id=?";
  $message = "Address updated successfully \n";
  updateValue($bdd, $sql, $n, $message);
}

if (isset($_POST['email']) and $_POST['email'] !== $email) {
  $n = $_POST['email'];
  $mybdd = mysqli_connect('localhost', 'root', '', 'databaseSchool');

  $sqls = "SELECT userEmail FROM users WHERE userEmail=$n";

  if (!mysqli_query($mybdd, $sqls)) {
    $sql = "UPDATE users SET userEmail=? WHERE user_id= ?";
    $message ="Email updated successfully \n Please login again";
    updateValue($bdd, $sql, $n, $message);
  }else {
    echo "Email already exist \n";
  }
}

if (isset($_POST['password']) && !empty($_POST['password']) and isset($_POST['2password'])) {
  $password = htmlspecialchars($_POST['password']);
  $password_retype = htmlspecialchars($_POST['2password']);

  if ($password == $password_retype) {
    $cost = ['cost' => 12];
    $password = password_hash($password, PASSWORD_BCRYPT, $cost);
    $sql = "UPDATE users SET userPwd=? WHERE user_id=?";
    updateValue($bdd, $sql, $password, '');

    header('Location: ../deconnexion.php');
    die();
  } else {
    header('Location: adminprofil.php?error=false');
    die();
  }
}
