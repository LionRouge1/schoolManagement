<?php
session_start();
require_once '../config.php';
require 'modules/Display.php';
require 'modules/filter.php';
$userpage = true;
$who = $_SESSION['who'];
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

  <script src="https://kit.fontawesome.com/84967187a9.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/app.css">
  <title>Views teachers</title>
</head>

<body>
  <?php
  include 'header.php';
    $filter = new Filter($bdd);

    $main = $filter->mainfilter();
  ?>
  <script src="../js/adminjs.js"></script>
  <script src="../js/filtring.js"></script>
</body>
</html>