<?php
session_start();
require_once '../config.php';
require 'modules/Display.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/admin1.css">
  <link rel="stylesheet" href="css/adminstylew.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>Document</title>
</head>

<body>
  <?php 
  include '../header.php';
  $teachers = new Display($bdd, false);
  $message = $teachers->message();

  $sql = 'SELECT u.user_id AS ID, u.userName AS Name, u.userSurname AS Surname, u.userEmail as Email, u.userContact, u.userAddress, u.gender,
  u.status, l.region, l.ctyName
  FROM users u JOIN locations l ON u.user_id = l.location_id';
  
  $delete = $teachers->deleteElement();
  $heads = array(
    'Name',
    'Surname',
    'Email',
    'Contact',
    'Address',
    'Gender',
    'Status',
    'Region',
    'City'
  );
  $teacher = $teachers->displayelement($sql, $heads);
  ?>
  <script src="../js/adminjs.js"></script>
</body>

</html>