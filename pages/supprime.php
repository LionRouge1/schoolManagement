<?php
session_start();
if(!isset($_SESSION['id'])){
  header('Location: administrator.php');die();}

if (isset($_POST['delete'])) {
  $id=$_POST['delete'];
  $delete=$bdd->prepare('DELETE FROM teachers WHERE teacher_id = ?');
  $delete->execute(array($id));

  header('Location: administrator.php?fid=true');die();
}else {
  header('Location: administrator.php?fid=false');die();
}
?>
