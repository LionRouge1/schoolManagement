<?php
session_start();
require_once 'config.php';
$who = $_SESSION['who'];
print $who;

function openSession($data, $row, $password, $who)
{
  
  if ($row == 1) {


    if (password_verify($password, $data['Password'])) {
      $_SESSION['id'] = $data['ID'];
      $_SESSION['name'] = $data['Name'];
      $_SESSION['surname'] = $data['surname'];
      $_SESSION['email'] = $data['Email'];
      
      header('Location: pages/'.$who.'.php');
      die();
    } else {
      header('Location: login.php?login_err=password');
      die();
    }
  }
  
  header('Location: login.php?login_err=already');
}

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  switch($who) {
    case 'users':
      $check = $bdd->prepare('SELECT user_id AS ID, userName AS Name, userSurname AS surname, userEmail AS Email, userPwd AS Password FROM users WHERE userEmail = ?');
      $check->execute(array($email));
      $data = $check->fetch();
      $row = $check->rowCount();
      openSession($data, $row, $password, $who);
      break;

    case 'teachers':
      $check = $bdd->prepare('SELECT teacher_id AS ID, tchName AS Name, tchSurname AS surname, tchEmail AS Email, tchPwd AS Password FROM teachers WHERE tchEmail = ?');
      $check->execute(array($email));
      $data = $check->fetch();
      $row = $check->rowCount();
      openSession($data, $row, $password, $who);
      break;

    case 'admin':
      $admin = $bdd->prepare('SELECT * FROM administrator WHERE adminEmail = ?');
      $admin->execute(array($email));
      $dataAdmin = $admin->fetch();
      $rowAdmin = $admin->rowCount();
      if ($rowAdmin == 1) {
        if ($password == $dataAdmin['adminPwd']) {
          $_SESSION['id'] = $dataAdmin['admin_id'];
          $_SESSION['password'] = $dataAdmin['adminPwd'];
          $_SESSION['email'] = $dataAdmin['adminEmail'];
          header('Location: pages/administrator.php');
          die();
        } else {
          header('Location: login.php?login_err=passwordAdmin');
          die();
        }
      } else {
        header('Location: login.php?login_err=already');
        die();
      };
      break;
    
    default :
      header('Location: deconnexion.php');
      die();
      break;
  }
}
