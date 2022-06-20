<?php 
session_start();
require_once '../config.php';
require 'modules/addSubjec.php';

$subject = new Subject($bdd);
if(isset($_GET['subject'])){
  $delete = $subject->deleteSubject();
  header('Location: adminprofil.php'); die();
}


$add = $subject->addSubject();
header('Location: adminprofil.php'); die();
?>