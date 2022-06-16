<?php
session_start();
if(!isset($_SESSION['id']) AND !isset($_GET['id'])){
  header('Location: ../login.php');die();}
  require_once '../config.php';
  $key=$_GET['id'];

  $utilisateur= $bdd->prepare('SELECT * FROM utilisateurs WHERE utilisateur_id= ?');
  $utilisateur->execute(array($key));
  $userData = $utilisateur->fetch();

  $beneficiare= $bdd->prepare('SELECT * FROM beneficiare WHERE utilisateur_id= ?');
  $beneficiare->execute(array($key));
  $row =$beneficiare->rowCount();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User profil</title>
  </head>
  <body>
    <?php
      include 'header.php';
     ?>
     <link rel="stylesheet" href="css/userprofilstyle.css">
    <section>
      <article class="boxinfo">
        <div class="userId">
          <img src="../images/avatars/<?=$userData['avatar'];?>" alt="User ID">
          <a href="../images/avatars/<?=$userData['avartar'];?>" download="../image/photo/<?='userid'.$userData['Photo'];?>" class="down"> Cliquer sur l'image pour le télécharger</a>
        </div>
        <h3>les informations personelles de utilisateurs</h3>
        <div class="info">
          <p><strong>identifiant :</strong> 19174<?=$userData['utilisateur_id'];?></p>
          <p><strong>Nom : </strong><?=$userData['Nom'].' '.$userData['Prenom'];?></p>
          <p><strong>Profession : </strong><?=$userData['Profession'];?></p>
          <p><strong>Pays : </strong><?=$userData['Pays'];?></p>
          <p><strong>Ville : </strong><?=$userData['Ville'];?></p>
          <p><strong>Email : </strong><?=$userData['Email'];?></p>
          <p><strong>Phone : </strong><?=$userData['Phone'];?></p>
          <p><strong>Date de naissance : </strong><?=$userData['Date_N'];?></p>
          <p><strong>Occupation : </strong><?=$userData['Occupation'];?></p>
          <p><strong>Statut : </strong><?=$userData['Statut'];?> <strong>Sexe : </strong><?=$userData['Sexe'];?> </p>
          <p><strong>Address : </strong><?=$userData['Address'];?></p>
        </div>
      </article>
      <article class="virement">
        <h3>Les virements éffectués par l'utilisateurs</h3>
          <?php
          if ($row == 0) {
            echo "No transfer yet";
          }else {
            ?>
            <div class="">
              <?php
              while ($userVT = $beneficiare->fetch()) {
                ?>
                <p> <strong>Virement ID :</strong> VT20167786<?=$userVT['Beneficiare_id'];?></p>
                <p><strong>Nom de la bank : </strong><?=$userVT['Nom'];?></p>
                <p><strong><?=$userVT['Type'];?> : </strong><?=$userVT['IBAN'];?></p>
                <p><strong>Montant : </strong><?=$userVT['Montant'].' '.$userVT['current'];?></p>
                <p><strong>Date_Execution : </strong><?=$userVT['Date_Execution'];?></p>
                <p><strong>Nom du compte a credité : </strong><?=$userVT['Account_N'];?></p>
                <p><strong>chargement : </strong><?=$userVT['chargement'];?>%</p>
                <p><strong>Virement lancé le : </strong><?=$userVT['Date_of_trans'];?></p>
                <?php
              }
              ?>
              </div>
              <?php
          }
           ?>
      </article>
      <a href="administrator.php">Retour</a>
    </section>
  </body>
</html>
