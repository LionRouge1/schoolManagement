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
          if(isset($_GET['reg_err']))
          {
              $err = htmlspecialchars($_GET['reg_err']);

              switch($err)
              {
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
    <h1>Teacher registration:</h1>

    <!-- One "tab" for each step in the form: -->
    <div class="champ">Personal information:
     <p><label for="file" style="cursor: pointer;">Upload passport picture</label></p>
     <p><img id="output" width="300" /></p>
     <p><input type="file" accept="image/*" name="avatar" id="file"  onchange="loadFile(event)" style="display: block;" oninput="this.className = ''"></p>
     <p><input placeholder="First name..." type="text" name="firstName" oninput="this.className = ''"></p>
     <p><input placeholder="Last name..." type="text" name="lastName" oninput="this.className = ''"></p>
     <p><input placeholder="School name..." type="text" name="schoolName" oninput="this.className = ''"></p>
    </div>

    <div class="champ">Contact Information:
     <p class="autocomplete"><input id="myInput" type="text" name="myCountry" placeholder="Country of Residence..."></p>
     <p> <input type="text" name="city" placeholder="City..."> </p>
     <p><input placeholder="Email Address..." type="email" name="email" oninput="this.className = ''"></p>
     <p><input placeholder="Phone Number..." name="phone" oninput="this.className = ''"></p>
    </div>

    <div class="champ">Birthday & Status:
     <p><input type="date" placeholder="Date of Birth..." name="date" oninput="this.className = ''"></p>
     <p> <input type="text" name="occupation" placeholder="Occupation"> </p>
     <p><h5>Marital Status</h5>
       <select class="status" name="status" oninput="this.className = ''">
       <option></option>
       <option value="Célibataire">Single</option>
       <option value="Marrié">Married</option>
       <option value="Divorcée">Divorcee</option>
       <option value="Séparé">Separated</option>
       <option value="Veuf/Veuve">Widowed</option>
     </select> </p>
     <p><h5>Gender</h5>
     <input type="radio" name="gender" value="M">Male
     <input type="radio" name="gender" value="F">Female</p>
    </div>

    <div class="champ">Login Information:
     <p><input placeholder="Home Address..." type="text" name="address" oninput="this.className = ''"></p>
     <p><input placeholder="Password..." type="password" name="pwd" oninput="this.className = ''"></p>
     <p><input placeholder="Confirm Password..." type="password" name="confirmpwd" oninput="this.className = ''"></p>
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

    </form>

    <script type="text/javascript" src="js/registeJs.js">

    </script>
  </body>
</html>
