<?php
session_start();
require_once 'config.php';

if (!empty($_POST['email']) && !empty($_POST['pwd']) && !empty($_POST['confirmpwd'])) {
    $name = htmlspecialchars($_POST['firstName']);
    $surname = htmlspecialchars($_POST['lastName']);
    $region = htmlspecialchars($_POST['region']);
    $city = htmlspecialchars($_POST['city']);
    $email = htmlspecialchars($_POST['email']);
    $contact = htmlspecialchars($_POST['contact']);
    $sexe = htmlspecialchars($_POST['gender']);
    $address = htmlspecialchars($_POST['address']);
    $password = htmlspecialchars($_POST['pwd']);
    $password_retype = htmlspecialchars($_POST['confirmpwd']);
    $who = $_SESSION['who'];
    switch ($who) {
        case 'teachers':
            include 'teacher.php';
            break;
        
        case 'users':
            include 'users.php';
            break;
        
        default:
            header('Location: index.php');
            die();
    }
}
