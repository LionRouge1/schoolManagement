<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('Location: index.php');
  die();
}
require_once '../config.php';
require '../pages/modules/Books.php';


$obj = new Books($bdd);
if (isset($_GET['id'])) {
  $delete = $obj->remove();
}
if (isset($_FILES['book'])) {
  $add = $obj->addBook();
}
if (isset($_GET['file_id'])) {
  $download = $obj->download();
}
