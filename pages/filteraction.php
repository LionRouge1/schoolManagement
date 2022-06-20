<?php
session_start();
require_once '../config.php';
require 'modules/Display.php';
require 'modules/filter.php';
$userpage = true;
$who = $_SESSION['who'];
$data2 = new Sorting($bdd);
$all = $data2->filtBy();
?>