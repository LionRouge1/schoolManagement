<?php 
session_start(); 
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="School management">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/index.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <?php 
    function persons($who){
      $_SESSION['who'] = $who;
      header('Location: login.php'); die();
    }

    if(isset($_GET['who'])) {
      persons($_GET['who']);
    }
    ?>
    <div class="d-flex flex-row bg-image align-item-center"
    style="background-image: url('images/children.png');
    height:100vh; width:100%">
      <div class="card p-2 m-5 border"><a href="index.php?who=admin">Login as Admin</a></div>
      <div class="card p-2 m-5 border"><a href="index.php?who=users">Login as User</a></div>
      <div class="card p-2 m-5 border"><a href="index.php?who=teachers">Login as Teacher</a></div>
    </div>
  </body>
</html>