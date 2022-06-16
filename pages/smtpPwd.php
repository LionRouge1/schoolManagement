<?php
require_once '../config.php';
if (isset($_POST['EmailPwd'])) {

  $smtpPwd=$_POST['EmailPwd'];
  $adminup= $bdd->prepare('UPDATE administrator SET EmailPwd=? WHERE administrator_id=1');
  $adminup->execute(array($smtpPwd));
  header('Location: adminprofil.php?error=true&id=1');die();
}else {
  header('Location: adminprofil.php?error=true&id=1');die();
}
 ?>
