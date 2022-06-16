<?php
$category = htmlspecialchars($_POST['category']);
$status = htmlspecialchars($_POST['status']);
$demandeId = $bdd->query('SELECT COUNT(user_id) AS UNB FROM users');
$supId = $demandeId->fetch();

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

                $sqlc = 'INSERT INTO locations(region, ctyName)
                                VALUES(:region, :city)';
                $location = $bdd->prepare($sqlc);
                $location->execute(array(
                    'region' => $region,
                    'city' => $city
                ));

                $location = $bdd->query('SELECT COUNT(location_id) AS UNB FROM locations');
                $locationId = $location->fetch();
                
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
                        'location_id' => $locationId['UNB']
                    ));

                $subjSql = 'INSERT INTO uers_categories(user_id, category_id)
                                    VALUES(:user_id, :category_id)';
                $subjInsert = $bdd->prepare($subjSql);
                $subjInsert->execute(array(
                    'user_id' => $supId['UNB'] + 1,
                    'category_id' => $category
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
