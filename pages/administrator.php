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
  <?php include '../header.php'; 
  $teachers = new Display($bdd);
  $message = $teachers->message();
  ?>
  
  <section>

    <?php
    $sql = 'SELECT t.teacher_id AS ID, t.tchName AS Name, t.tchSurname AS Surname, t.schoolName, t.tchEmail as Email, t.contact, t.qualification, t.address, t.gender,
    l.region, l.ctyName
    FROM teachers t JOIN locations l ON t.teacher_id = l.location_id';
    
    $delete = $teachers->deleteElement();
    $heads = array('Name',
    'Surname',
    'School Name',
    'Email',
    'Contact',
    'Qualification',
    'Address',
    'Gender',
    'Region',
    'City');
    $teacher = $teachers->displayelement($sql, $heads, 'query');
    ?>

    <a href="adminprofil.php?id=1" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Change admin password</a>
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
            <form action="" method="post">
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

          <?php
          if (isset($_POST['email']) and $_POST['email'] !== $rech['adminEmail']) {
            $email = htmlspecialchars($_POST['email']);
            $adminup = $bdd->prepare('UPDATE administrator SET adminEmail=? WHERE admin_id=1');
            $adminup->execute(array($email));
            header('Location: administrator.php');
            die();
          }

          if (isset($_POST['password']) and isset($_POST['2password'])) {
            $password = htmlspecialchars($_POST['password']);
            $password_retype = htmlspecialchars($_POST['2password']);


            if ($password == $password_retype) {

              $adminup = $bdd->prepare('UPDATE administrator SET password=? WHERE admin_id=1');
              $adminup->execute(array($password));
              header('Location: administrator.php');
              die();
            } else {
              echo '<div class="alert alert-danger"><strong>Error!! </strong> Different password</div>';
            }
          }
          ?>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="../js/adminjs.js"></script>
</body>

</html>