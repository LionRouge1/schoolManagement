<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  die();
}
require_once '../config.php';
require 'modules/Display.php';

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
  ?>

  <main>
    <section id="teachers">
      <?php
      $sql = 'SELECT t.teacher_id AS ID, t.avatar, t.tchName AS Name, t.tchSurname AS Surname, t.schoolName, t.tchEmail as Email, t.contact, t.qualification, t.address, t.gender,
    l.region, l.ctyName
    FROM teachers t JOIN locations l ON t.teacher_id = l.location_id';

      $delete = $teachers->deleteElement();
      $heads = array(
        'Picture',
        'Name',
        'Surname',
        'School Name',
        'Email',
        'Contact',
        'Qualification',
        'Address',
        'Gender',
        'Region',
        'City'
      );
      $teacher = $teachers->displayelement($sql, $heads, 'query', true, true);
      ?>

      <a href="adminprofil.php?id=1" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Change admin password</a>
    </section>

    <section id="users">
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
        'City',
        'Action'
      );
      $teacher = $teachers->displayelement($sql, $heads, 'query', false);
      ?>
    </section>
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <?php
          $adminis = $bdd->prepare('SELECT * FROM administrator WHERE admin_id = ?');
          $adminis->execute(array($_SESSION['id']));
          $rech = $adminis->fetch();
          ?>
          <div class="modal-header">
            <h4 class="modal-title">Change admin password</h4>
          </div>
          <div class="modal-body">
            <form action="../adminaction.php" method="post">
              <div><label for="email">Login Email :</label>
                <input type="email" id="email" name="email" value="<?= $rech['adminEmail'] ?>" required>
              </div>
              <div><label for="password">New password:</label>
                <input type="password" name="password" id="password" placeholder="Entrer le nouveau mot de passe">
              </div>
              <div><label for="2password">Confirm password :</label>
                <input type="password" name="2password" id="2password" placeholder="confirmer le mot de passe">
              </div>
              <input type="submit" value="changer">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="../js/adminjs.js"></script>
</body>

</html>