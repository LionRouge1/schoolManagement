<?php
$subject = htmlspecialchars($_POST['subject']);
$qualification = htmlspecialchars($_POST['qualification']);
$schoolName = htmlspecialchars($_POST['schoolName']);
$demandeId = $bdd->query('SELECT COUNT(teacher_id) AS UNB FROM teachers');
$supId = $demandeId->fetch();

$check = $bdd->prepare('SELECT tchEmail, tchPwd FROM teachers WHERE tchEmail = ?');
$check->execute(array($email));
$data = $check->fetch();
$row = $check->rowCount();

if ($row == 0) {
  if (strlen($email) <= 100) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      if ($password == $password_retype) {

        $cost = ['cost' => 12];
        $password = password_hash($password, PASSWORD_BCRYPT, $cost);

        $sqlc = 'INSERT INTO locations(region, ctyName)
                                VALUES(:region, :city)';
        $location = $bdd->prepare($sqlc);
        $location->execute(array(
          'region' => $region,
          'city' => $city
        ));
        $location = $bdd->query('SELECT COUNT(location_id) AS UNB FROM locations');
        $locationId = $location->fetch();
        if (!empty($_FILES['avatar']['name'])) {
          $imageFileType = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
          $nbUser = $supId['UNB'] + 1;
          $photo = $nbUser . '.' . $imageFileType;
          $chemin = 'images/avatars/' . $photo;
          $charge = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);

          $insert = $bdd->prepare('INSERT INTO teachers(avatar, tchName, tchSurname, schoolName, tchEmail, contact, qualification, address, tchPwd, location_id, gender)
                                VALUES(:avatar, :tname, :surname, :school, :email, :contact, :qualification, :taddress, :pwd,
                                :location_id, :gender)');
          $insert->execute(array(
            'avatar' => $photo,
            'tname' => $name,
            'surname' => $surname,
            'school' => $schoolName,
            'email' => $email,
            'contact' => $contact,
            'qualification' => $qualification,
            'taddress' => $address,
            'pwd' => $password,
            'location_id' => $locationId['UNB'],
            'gender' => $sexe
          ));
        } else {
          $insert = $bdd->prepare('INSERT INTO teachers(tchName, tchSurname, schoolName, tchEmail, contact, qualification, address, tchPwd, location_id, gender)
                                VALUES(:tname, :surname, :school, :email, :contact, :qualification, :taddress, :pwd,
                                :location_id, :gender)');
          $insert->execute(array(
            'tname' => $name,
            'surname' => $surname,
            'school' => $schoolName,
            'email' => $email,
            'contact' => $contact,
            'qualification' => $qualification,
            'taddress' => $address,
            'pwd' => $password,
            'location_id' => $locationId['UNB'],
            'gender' => $sexe
          ));
        }
        $subj = $bdd->prepare('SELECT subject_id FROM subjects WHERE sbtName = ?');
        $subj->execute(array($subject));
        $subjId = $subj->fetch();

        $subjSql = 'INSERT INTO subjects_teachers(subject_id, teacher_id)
                                    VALUES(:subject_id, :teacher_id)';
        $subjInsert = $bdd->prepare($subjSql);
        $subjInsert->execute(array(
          'subject_id' => $subjId['subject_id'],
          'teacher_id' => $supId['UNB'] + 1
        ));

        header('Location: registe.php?reg_err=success&who=' . $who);
        die();
      } else {
        header('Location: registe.php?reg_err=password&who=' . $who);
        die();
      }
    } else {
      header('Location: registe.php?reg_err=email&who=' . $who);
      die();
    }
  } else {
    header('Location: registe.php?reg_err=email_length&who=' . $who);
    die();
  }
} else {
  header('Location: registe.php?reg_err=already&who=' . $who);
  die();
}
