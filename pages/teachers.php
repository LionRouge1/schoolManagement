<?php 
session_start();
if(!isset($_SESSION['id'])) {
  header('Locaton: ../deconnexion.php'); die();
}
$id = $_SESSION['id'];
require_once '../config.php';
require '../pages/modules/Display.php';

$rating = new Display($bdd, false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css/teachers.css">
  <title>Document</title>
</head>
<body>
  <?php 
  $sql = 'SELECT t.teacher_id as ID, r.rate, r.RDate, r.comments, u.userName, u.userSurname FROM teachers t JOIN rating r on  t.teacher_id = r.teacher_id 
  join users u on r.user_id = u.user_id where t.teacher_id = ?';
  
  $sql1 = 'SELECT * FROM teachers where teacher_id = ?';
  $connexion = $bdd->prepare($sql1);
  
  $connexion->execute(array($id));
  $teacher = $connexion->fetch();
  $avatar = $teacher['avatar'];
  ?>
  <div class="container-fluid bar" style="background-image: url('../images/book.jpeg'); height: 200px; background-size:cover">
  <?php include 'header.php';?>
  <div class="float-end pt-3 pe-5"><?=$teacher['tchName']. ' '. $teacher['tchSurname']?></div>
  </div>
  
  <?php 
  $head = array('Rate', 'Date', 'Comment', 'Name', 'Surname');
  $rate = $rating->displayelement($sql, $head, 'prepare',$id);
  ?> 
</body>
</html>