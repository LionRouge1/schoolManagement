<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  die();
}
require_once '../config.php';
require 'modules/Display.php';
$pageuser = true;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="description" content="loan for individuals">
  <meta name="keywords" content="loan, investment">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/admin1.css">
  <link rel="stylesheet" href="css/adminstylew.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>Administrateur</title>
</head>

<body>
  <?php
  include '../header.php';
  ?>
  <link rel="stylesheet" href="css/app.css">
  <?php
  $teachers = new Display($bdd);
  $message = $teachers->message();
  print_r($message);
  ?>

  <main>
    <section>
      <?php
      $sql = 'SELECT u.user_id AS ID, u.userName AS Name, u.userSurname AS Surname, u.userEmail as Email, u.userContact, u.userAddress, u.gender,
        u.status, l.region, l.ctyName
        FROM users u JOIN locations l ON u.user_id = l.location_id';

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
      $teacher = $teachers->displayelement($sql, $heads, 'query', false);
      ?>
    </section>
  </main>
  <script>
    function tableFilter(who = '') {
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