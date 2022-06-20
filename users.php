<?php
$category = htmlspecialchars($_POST['category']);
$status = htmlspecialchars($_POST['status']);

$check = $bdd->prepare('SELECT userEmail, userPwd FROM users WHERE userEmail = ?');
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
                  $locatio = $loco['location_id'] + 1;
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
        


                $insert = $bdd->prepare('INSERT INTO users(userName, userSurname, userEmail, userPwd, userContact, userAddress, gender, status, location_id)
                                VALUES(:uname, :surname, :email, :pwd, :contact, :taddress, :gender, :ustatus, :location_id)');
                $insert->execute(array(
                    'uname' => $name,
                    'surname' => $surname,
                    'email' => $email,
                    'pwd' => $password,
                    'contact' => $contact,
                    'taddress' => $address,
                    'gender' => $sexe,
                    'ustatus' => $status,
                    'location_id' => $locatio
                ));

                $sqlLast = 'SELECT user_id FROM users WHERE userEmail = ?';
                $lastex = $bdd->prepare($sqlLast);
                $lastex->execute(array($email));
                $last = $lastex->fetch();

                $subjSql = 'INSERT INTO uers_categories(user_id, category_id)
                                    VALUES(:user_id, :category_id)';
                $subjInsert = $bdd->prepare($subjSql);
                $subjInsert->execute(array(
                    'user_id' => $last['user_id'],
                    'category_id' => $category
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
