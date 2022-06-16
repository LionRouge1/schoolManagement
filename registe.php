<?php
session_start();
$who = $_SESSION['who'];
switch ($who) {
  case 'teachers':
    $title = 'Teacher registration';
    break;
  case 'users':
    $title = 'Users registration';
    break;
  default :
  header('Location: deconnexion.php');
  die();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="styles/registeStyle.css">
  <link rel="stylesheet" href="styles/alert.css">
  <title>Registration</title>
</head>

<body>

  <form id="regForm" action="registe_traitement.php" method="post" enctype="multipart/form-data">
    <?php
    if (isset($_GET['reg_err'])) {
      $err = htmlspecialchars($_GET['reg_err']);

      switch ($err) {
        case 'success':
    ?>
          <div class="alert alert-success">
            <strong>Success</strong> successful registration!
          </div>
        <?php
          break;

        case 'password':
        ?>
          <div class="alert alert-danger">
            <strong>Error</strong> different password
          </div>
        <?php
          break;

        case 'email':
        ?>
          <div class="alert alert-danger">
            <strong>Error</strong> invalid email
          </div>
        <?php
          break;

        case 'email_length':
        ?>
          <div class="alert alert-danger">
            <strong>Error</strong> mail too long
          </div>
        <?php
          break;

        case 'pseudo_length':
        ?>
          <div class="alert alert-danger">
            <strong>Error</strong> pseudo too long
          </div>
        <?php
        case 'already':
        ?>
          <div class="alert alert-danger">
            <strong>Error</strong> already existing account
          </div>
    <?php

      }
    }
    ?>
    <h1><?= $title ?></h1>

    <!-- One "tab" for each step in the form: -->
    <div class="champ">Personal information:
      <?php if ($who == 'teachers') :
      ?>
        <p><label for="file" style="cursor: pointer;">Upload profile picture</label></p>
        <p><img id="output" width="300" /></p>
        <p><input type="file" accept="image/*" name="avatar" id="file" onchange="loadFile(event)" style="display: block;" oninput="this.className = ''"></p>
      <?php
      endif ?>
      <p class="required"><input placeholder="First name..." type="text" name="firstName" oninput="this.className = ''"></p>
      <p class="required"><input placeholder="Last name..." type="text" name="lastName" oninput="this.className = ''"></p>
      <?php if ($who == 'teachers') :
      ?><p class="required"><input placeholder="School name..." type="text" name="schoolName" oninput="this.className = ''"></p><?php
      endif ?>
      <?php if ($who == 'users') :
      ?>
        <p>
        <select class="status" name="status" oninput="this.className = ''">
          <option value="">Select status__</option>
          <option value="parent">Parent</option>
          <option value="student">Student</option>
        </select> </p>
      <?php
      endif ?>
    </div>

    <div class="champ">Contact Information:
      <p class="autocomplete required"><input id="myInput" type="text" name="region" placeholder="Region of Residence..."></p>
      <p class="required"><input type="text" name="city" placeholder="City..."> </p>
      <p class="required"><input placeholder="Email Address..." type="email" name="email" oninput="this.className = ''"></p>
      <p class="required"><input placeholder="Phone Number..." name="contact" oninput="this.className = ''"></p>
    </div>

    <div class="champ">Qualification & Status:
      <?php if ($who == 'teachers') :
      ?>
        <p class="autocomplete required"><input type="text" placeholder="Subject..." name="subject" id="subject" oninput="this.className = ''"></p>
      <?php
      else :
      ?>
        <p>
        <h5>Student field</h5>
        <select class="status" name="category" oninput="this.className = ''">
          <option value="">Select field__</option>
          <option value="1">GENERAL ARTS</option>
          <option value="2">TECHNICAL</option>
          <option value="3">GENERAL</option>
          <option value="4">GENERAL SCIENCE</option>
          <option value="5">BUSINESS</option>
          <option value="6">VISUAL ARTS</option>
        </select> </p>
      <?php
      endif ?>
      <p class="required"><input type="text" name="qualification" placeholder="qualification..."> </p>
      <p class="required">
      <h5>Gender</h5>
      <input type="radio" name="gender" value="M">Male
      <input type="radio" name="gender" value="F">Female</p>
    </div>

    <div class="champ">Login Information:
      <p class="required"><input placeholder="Home Address..." type="text" name="address" oninput="this.className = ''"></p>
      <p class="required"><input placeholder="Password..." type="password" name="pwd" oninput="this.className = ''"></p>
      <p class="required"><input placeholder="Confirm Password..." type="password" name="confirmpwd" oninput="this.className = ''"></p>
    </div>

    <div style="overflow:auto;">
      <div style="float:right;">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
      </div>
    </div>

    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
    </div>
    <a href="javascript:history.go(-1)" class="back"><-Go back</a>
  </form>

  <script type="text/javascript" src="js/registeJs.js">

  </script>
</body>

</html>