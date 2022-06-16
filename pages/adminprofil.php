<?php
  session_start();
  ob_start();
  require_once '../config.php';
  if (isset($_GET['id']) AND $_GET['id']==1) {
    $adminis= $bdd->prepare('SELECT * FROM administrator WHERE admin_id = ?');
    $adminis->execute(array($_GET['id']));
    $rech=$adminis->fetch();
 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="loan for individuals">
    <meta name="keywords" content="loan, investment">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/alert.css">
    <title>My profil</title>
    <style media="screen">
      .profil{
        margin-left: 5%;
      }
      section label, section input{
        display: inline-block;
        width: 45%;
        margin: 10px 0px 10px 0px;
      }
      section input[type="submit"]{
        margin-left: 35%;
      }
      section{
        display: inline-block;
        width: 40%;
        margin: 2%;
      }
      section form {
        width: 100%;
        min-width: 341px;
        border-radius: 5px;
        box-shadow: 0px 0px 15px #ccc;
        padding: 10px;
      }
      section p{
        color: red;
        font-size: 14px;
      }
      #view{
        width: 30px;
        margin-left: 46%;
      }
      @media (max-width:850px) {
        section{
          display: block;
          margin-left: 5%;
        }
      }
    </style>
  </head>
  <body>
    <?php include '../header.php';  ?>
    <section class="profil">
      <form action="" method="post">
        <label for="email">Login Email :</label>
        <input type="email" id="email" name="email" value="<?=$rech['adminEmail']?>"  required>
        <label for="password">New:</label>
        <input type="password" name="password" id="password" placeholder="Entrer le nouveau mot de passe" >
        <label for="2password">Confirmez mot de passe :</label>
        <input type="password" name="2password" id="2password" placeholder="confirmer le mot de passe">
        <input type="submit" value="changer">
        <a style="display:block; margin-left: 30%;" href="administrator.php">Annuller</a>
      </form>
      <?php
        if (isset($_POST['email']) AND $_POST['email']!==$rech['email']) {
          $email=htmlspecialchars($_POST['email']);
          $adminup= $bdd->prepare('UPDATE administrator SET adminEmail=? WHERE admin_id=1');
          $adminup->execute(array($email));
          header('Location: administrator.php');die();
        }

         if (isset($_POST['password']) AND isset($_POST['2password'])) {
          $password=htmlspecialchars($_POST['password']);
          $password_retype=htmlspecialchars($_POST['2password']);


          if ($password==$password_retype) {
            $cost = ['cost' => 12];
            $password = password_hash($password, PASSWORD_BCRYPT, $cost);


            $adminup= $bdd->prepare('UPDATE administrator SET password=? WHERE admin_id=1');
            $adminup->execute(array($password));
            header('Location: administrator.php');die();
          }else {
            echo'<div class="alert alert-danger"><strong>Error!! </strong> confirmation mot de passe differente</div>';
          }
        }
       ?>
    </section>
    <section>
      <?php
      if(isset($_GET['error']))
      {
        $err = htmlspecialchars($_GET['error']);

        switch($err)
        {
          case 'true':
          ?>
          <div class="alert alert-success">
            <strong>Success</strong> Mot de passe changer avec succès!
          </div>
          <?php
          break;

          case 'false':
          ?>
          <div class="alert alert-danger">
            <strong>Error</strong> Opperation échouer
          </div>
          <?php
          break;

        }
      }
      ?>
    </section>
  </body>
  <script type="text/javascript">
    var EmailPwd = document.getElementById('mailPwd');
    var view = document.getElementById('view');

    function txtView(){
      if (view.checked) {
        EmailPwd.type="text";
      }else {
        EmailPwd.type="password";
      }
    }
  </script>
</html>
<?php
}else {
  header('Location: administrator.php');die();
}
?>
