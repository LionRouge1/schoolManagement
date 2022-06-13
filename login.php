<?php
  if(!isset($_GET['who'])) {
    header('Location: index.php'); die();
  }

  $who = $_GET['who'];

  if($who === 'users'){
    print('Welcome to users page');
  }else if($who === 'admin') {
    print('Welcome to the admin page');
  }
?>