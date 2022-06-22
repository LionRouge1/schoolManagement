<?php 
session_start();
require_once '../config.php';
require 'modules/rate.php';

$add = new Rating($bdd);
$addrat = $add->addRate();
$delete = $add->deleteRate();