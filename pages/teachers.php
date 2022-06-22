<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('Locaton: ../deconnexion.php');
  die();
}
$id = $_SESSION['id'];
$who = $_SESSION['who'];
$pagehome = true;
require_once '../config.php';
require '../pages/modules/rate.php';

$rating = new Rating($bdd);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/adminstylew.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../bookstore/style.css">
  <title>View rating</title>

  <style>
    .page{
      width: 800px;
      display: block;
      margin: 50px auto;
      box-shadow: 0 0 45 0 black;
    }
    ol li{
      height: 40px;
    }
    ol div{
      width: 100px;
      display: inline-block;
      font-size: 20px;
      text-align: center;
    }
  </style>
</head>

<body>
  <?php

  $sql1 = 'SELECT * FROM teachers where teacher_id = ?';
  $connexion = $bdd->prepare($sql1);

  $connexion->execute(array($id));
  $teacher = $connexion->fetch();
  $avatar = $teacher['avatar'];

  ?>
  <div>
    <?php include 'header.php'; ?>
    <p class="float-end mt-3 me-5 btn btn-outline-dark"><?= $teacher['tchName'] . ' ' . $teacher['tchSurname'] ?></p>
  </div>
  <section class="page">
    <?php
    $rates = $rating->displayRate();
    ?>
  </section>
  <script>
    function tableFilter() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.querySelector(".table");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {

    td = tr[i].getElementsByTagName("td")[0];
    console.log('admin')

    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
  </script>
</body>

</html>