<?php
session_start();
ob_start();
if(!isset($_SESSION['id'])) {
  header('Location: ../deconnexion.php'); die();
}
require_once '../config.php';
$who = $_SESSION['who'];
$id = $_SESSION['id'];
switch ($who) {
  case 'teachers':
    $adminis = $bdd->prepare('SELECT * FROM teachers WHERE teacher_id = ?');
    $adminis->execute(array($id));
    $rech = $adminis->fetch();
    $email = $rech['tchEmail'];
    $name = $rech['tchName'];
    $surname = $rech['tchSurname'];
    $password = $rech['tchPwd'];
    $school = $rech['schoolName'];
    $contact = $rech['contact'];
    $qualification = $rech['qualification'];
    $table = 'teachers';
    $idn = 'teacher_id';
    break;

  case 'admin':
    $adminis = $bdd->prepare('SELECT * FROM administrator WHERE admin_id = ?');
    $adminis->execute(array($_GET['id']));
    $rech = $adminis->fetch();
    break;
}
    if (isset($_POST['name']) and $_POST['name'] !== $name) {
      $sql = 'UPDATE teachers SET tchName =? WHERE teacher_id =?';
      $adminup= $bdd->prepare($sql);
      $adminup->execute(array($_POST['name'], $id));
      header('Location: adminprofil.php?error=true');
      die();
    }

    if (isset($_POST['surname']) and $_POST['surname'] !== $surname) {
      $sql = 'UPDATE teachers SET tchSurname =? WHERE teacher_id =?';
      $adminup= $bdd->prepare($sql);
      $adminup->execute(array($_POST['surname'], $id));
      header('Location: adminprofil.php?error=true');
      die();
    }

    if (isset($_POST['school']) and $_POST['school'] !== $school) {
      $sql = 'UPDATE teachers SET schoolName =? WHERE teacher_id =?';
      $adminup= $bdd->prepare($sql);
      $adminup->execute(array($_POST['school'], $id));
      print_r($adminup);
    }

    if (isset($_POST['contact']) and $_POST['contact'] !== $contact) {
      $sql = 'UPDATE teachers SET contact =? WHERE teacher_id =?';
      $adminup= $bdd->prepare($sql);
      $adminup->execute(array($_POST['contact'], $id));
      header('Location: adminprofil.php?error=true');
      die();
    }

    if (isset($_POST['qualification']) and $_POST['qualification'] !== $qualification) {
      $sql = 'UPDATE teachers SET qualification =? WHERE teacher_id =?';
      $adminup= $bdd->prepare($sql);
      $adminup->execute(array($_POST['qualification'], $id));
      header('Location: adminprofil.php?error=true');
      die();
    }

    if (isset($_POST['email']) and $_POST['email'] !== $email) {
      $sql = 'UPDATE teachers SET tchEmail =? WHERE teacher_id = ?';
      $adminup= $bdd->prepare($sql);
      $adminup->execute(array($_POST['email'], $id));
      header('Location: ../deconnexion.php');
      die();
    }

    if (isset($_POST['password']) && !empty($_POST['password']) and isset($_POST['2password'])) {
      $password = htmlspecialchars($_POST['password']);
      $password_retype = htmlspecialchars($_POST['2password']);

      if ($password == $password_retype) {
        $cost = ['cost' => 12];
        $password = password_hash($password, PASSWORD_BCRYPT, $cost);
        $sql = 'UPDATE teachers SET tchPwd = ? WHERE teacher_id =?';
        $adminup= $bdd->prepare($sql);
        $adminup->execute(array($password, $id));

        header('Location: ../deconnexion.php');
        die();
      } else {
        header('Location: adminprofil.php?error=false');
        die();
      }
    }
