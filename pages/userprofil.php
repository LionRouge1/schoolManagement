<?php
session_start();
ob_start();
if (!isset($_SESSION['id'])) {
  header('Location: ../deconnexion.php');
  die();
}

$bdd = mysqli_connect('localhost', 'root', '', 'databaseSchool');
$who = $_SESSION['who'];
$id = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE user_id=$id";

$result = mysqli_query($bdd, $sql);
$rech = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach($rech as $user):

$email = $user['userEmail'];
$name = $user['userName'];
$surname = $user['userSurname'];
$password = $user['userPwd'];
$contact = $user['userContact'];
$address = $user['userAddress'];


endforeach;

$table = 'users';
$idn = 'user_id';

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="description" content="loan for individuals">
  <meta name="keywords" content="loan, investment">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/alert.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>My profil</title>
  <style media="screen">
    .profil {
      margin-left: 5%;
    }

    section label,
    section input {
      display: inline-block;
      width: 45%;
      margin: 10px 0px 10px 0px;
    }

    section input[type="submit"] {
      margin-left: 35%;
    }

    section {
      display: inline-block;
      width: 40%;
      margin: 2%;
    }

    section form {
      width: 100%;
      min-width: 341px;
      border-radius: 5px;
      box-shadow: 0px 0px 15px #ccc;
      padding: 10px;
    }

    section p {
      color: red;
      font-size: 14px;
    }

    #view {
      width: 30px;
      margin-left: 46%;
    }

    @media (max-width:850px) {
      section {
        display: block;
        margin-left: 5%;
      }
    }
  </style>
</head>

<body>
  <?php include 'header.php';
  ?>
  <section class="profil">
    <form action="updateUser.php" method="post" class="justify-content-center">
      <div class="mb-3 mt-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Update name" name="name" value="<?= $name ?>">
      </div>
      <div class="mb-3 mt-3">
        <label for="surname" class="form-label">Surname:</label>
        <input type="text" class="form-control" id="surname" placeholder="Update surname" name="surname" value="<?= $surname ?>">
      </div>
      <div class="mb-3 mt-3">
        <label for="contact" class="form-label">contact:</label>
        <input type="text" class="form-control" id="contact" placeholder="Update contact" name="contact" value="<?= $contact ?>">
      </div>
      <div class="mb-3 mt-3">
        <label for="address" class="form-label">Address:</label>
        <input type="text" class="form-control" id="address" placeholder="Update address" name="address" value="<?= $address ?>">
      </div>
      <div class="mb-3 mt-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Update email" name="email" value="<?= $email ?>">
      </div>
      <div class="mb-3">
        <label for="pwd" class="form-label">Password:</label>
        <input type="password" name="password" id="password" placeholder="New password">
      </div>
      <div class="mb-3">
        <label for="pwd" class="form-label">Confirm:</label>
        <input type="password" name="2password" id="2password" placeholder="Confirm password">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="javascript:history.go(-1)" class="btn btn-primary">
        <-Go back</a>
    </form>

  </section>
  <section>
    <?php
    if (isset($_GET['error'])) {
      $err = htmlspecialchars($_GET['error']);

      switch ($err) {
        case 'true':
    ?>
          <div class="alert alert-success">
            <strong>Success!! </strong> Update successfully!
          </div>
        <?php
          break;

        case 'false':
        ?>
          <div class="alert alert-danger">
            <strong>Error</strong> Something went wrong!
          </div>
    <?php
          break;
      }
    }
    ?>
  </section>
</body>
<script type="text/javascript">
  var EmailPwd = document.getElementById('mailPwd');
  var view = document.getElementById('view');

  function txtView() {
    if (view.checked) {
      EmailPwd.type = "text";
    } else {
      EmailPwd.type = "password";
    }
  }
</script>

</html>