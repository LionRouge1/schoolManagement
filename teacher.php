<?php
$subject = htmlspecialchars($_POST['subject']);
$qualification = htmlspecialchars($_POST['qualification']);
$schoolName = htmlspecialchars($_POST['schoolName']);

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


        $loco = $bdd->prepare('SELECT * FROM locations WHERE region = ? AND ctyName = ? LIMIT 1');
        $loco->execute(array($region, $city));
        $locat = $loco->fetch();
        $count = $loco->rowCount();

        if ($count > 0) {
          $locatio = $locat['location_id'] + 1;
        } else {
          $loco= $bdd->query('SELECT location_id FROM locations ORDER BY location_id DESC LIMIT 1');
          $locat = $loco->fetch();
          $locatio = $locat['location_id'] + 1;

          $sqlc = 'INSERT INTO locations(location_id, region, ctyName)
        VALUES(:location_id, :region, :city)';
          $location = $bdd->prepare($sqlc);
          $location->execute(array(
            'location_id' => $locatio,
            'region' => $region,
            'city' => $city
          ));
        }

       

        if (!empty($_FILES['avatar']['name'])) {

          $lastId = $bdd->query('SELECT teacher_id FROM teachers ORDER BY teacher_id DESC LIMIT 1');
          $image = $lastId->fetch();
          $lastTeacher = $image['teacher_id'] + 1;

          $imageFileType = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
          $nbUser = $lastTeacher;
          $photo = $nbUser . '.' . $imageFileType;
          $chemin = 'images/avatars/' . $photo;
          $charge = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
        }
        $avatar = (isset($photo) ? $photo : 'avatar.png');
        $sql = 'INSERT INTO teachers (teacher_id, avatar, tchName, tchSurname, schoolName, tchEmail, contact, qualification, address, tchPwd, location_id, gender) 
        VALUES(:teacher_id, :avatar, :tname, :surname, :school, :email, :contact, :qualification, :taddress, :pwd, :location_id, :gender)';
        $insert = $bdd->prepare($sql);
        print_r($insert);
        $insert->execute(array(
          'teacher_id' => $lastTeacher,
          'avatar' => $avatar,
          'tname' => $name,
          'surname' => $surname,
          'school' => $schoolName,
          'email' => $email,
          'contact' => $contact,
          'qualification' => $qualification,
          'taddress' => $address,
          'pwd' => $password,
          'location_id' => $locatio,
          'gender' => $sexe
        ));


        $subj = $bdd->prepare('SELECT subject_id FROM subjects WHERE sbtName = ?');
        $subj->execute(array($subject));
        $subjId = $subj->fetch();

        $subjSql = 'INSERT INTO subjects_teachers(subject_id, teacher_id)
        VALUES(:subject_id, :teacher_id)';
        $subjInsert = $bdd->prepare($subjSql);
        $subjInsert->execute(array(
          'subject_id' => $subjId['subject_id'],
          'teacher_id' => $lastTeacher
        ));

        header('Location: login.php');
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
