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
  <title>Document</title>
</head>

<body>
  <?php
  include 'header.php';

  function showUser($bdd, $sql, $data)
  {
    $user = $data->fetch();
  ?>
    <div class="row text-center m-4">
      <?php
      do {
      ?>
        <div class="modal" id="id<?= $user['teacher_id'] ?>">
          <div class="modal-dialog">
            <span class="close" onclick="document.getElementById('<?= $user['teacher_id'] ?>').style.display='none'; 
          location.reload();" title="Fermer">&times</span>
            <div class="modal-content">
              <p class="line">
                <span><?= $user['tchName'] ?></span><span><?= $user['tchSurname'] ?></span>
              </p>
              <p><strong>Email :</strong> <?= $user['tchEmail'] ?></p>
              <p><strong>Region :</strong> <?= $user['region'] ?></p>
              <p><strong>City :</strong> <?= $user['ctyName'] ?></p>
              <p class="line">
              <p><strong>Gender :</strong> <?= $user['gender'] ?></p>
              <p><strong>Qualification :</strong> <?= $user['qualification'] ?></p>
              <p><strong>Contact :</strong> <?= $user['contact'] ?></p>
              <div class="modal-footer justify-content-center">
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="far fa-star"></i></span>
                <span><i class="far fa-star"></i></span>
                <span><i class="far fa-star"></i></span>
              </div>
            </div>

          </div>
        </div>

        <div id="id0<?= $user['teacher_id'] ?>" class="modal">
          <div class="modal-dialog">
            <div class="modal-content p-4 justify-content-center">
              <div class="modal-header" style="height: 100px;">
                <p><strong>Rate teacher </strong><?= $user['tchName'] . ' ' . $user['tchSurname'] ?></p>
              </div>
              <form action="rating.php?tid=<?= $user['teacher_id'] ?>" method="post">
                <div class="ratebox">
                  <input type="range" name="rate" min='1' max='10' id="Rid<?= $user['teacher_id'] ?>" onchange="rates('Rid<?= $user['teacher_id'] ?>')" required>
                  <span class="rateValue"></span>
                </div>
                <div>
                  <textarea name="comments" cols="30" rows="5" placeholder="Enter your comments here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>

        <div class="card m-2" style="width:400px">
          <img class="card-img-top" src="../images/avatars/<?= $user['avatar'] ?>" alt="Teacher picture" style="width:100%; height: 250px">
          <div class="card-body">
            <h4 class="card-title"><?= $user['tchName'] . ' ' . $user['tchSurname'] ?></h4>
            <p class="card-text"><?= $user['sbtName'] ?> teacher at <?= $user['schoolName'] ?> in the <?= $user['region'] ?> </p>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#id<?= $user['teacher_id'] ?>">Book</a>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#id0<?= $user['teacher_id'] ?>">Rate</a>
          </div>
        </div>
      <?php
      } while ($user = $data->fetch());
      ?>

    </div>
  <?php
  }
  $sql = 'SELECT * FROM teachers t JOIN locations l ON t.teacher_id = l.location_id
          JOIN subjects_teachers st ON t.teacher_id = st.teacher_id
          JOIN subjects s ON st.subject_id = s.subject_id';
  $utilisateur = $bdd->query($sql);
  showUser($bdd, $sql, $utilisateur);
  
  ?>
  <script src="../js/adminjs.js"></script>
</body>

</html>