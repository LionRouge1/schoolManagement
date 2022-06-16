<?php
session_start();
if(!isset($_SESSION['id'])){
  header('Location: index.php');die();}
require_once '../config.php';
require '../pages/modules/Books.php';
if(isset($_GET['id'])){
  $obj = new Books($bdd);
  $delete = $obj->remove();
  header('Location: index.php');
}
?>