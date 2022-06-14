<?php
    session_start();
    require_once 'config.php';

    if(!empty($_POST['email']) && !empty($_POST['pwd']) && !empty($_POST['confirmpwd']) && !empty($_FILES['imageID']['name']))
    {
        $name = htmlspecialchars($_POST['firstName']);
        $surname = htmlspecialchars($_POST['lastName']);
        $profession = htmlspecialchars($_POST['profession']);
        $pays = htmlspecialchars($_POST['myCountry']);
        $city = htmlspecialchars($_POST['city']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $DateN = htmlspecialchars($_POST['date']);
        $occupation = htmlspecialchars($_POST['occupation']);
        $statut = htmlspecialchars($_POST['status']);
        $sexe = htmlspecialchars($_POST['gender']);
        $address = htmlspecialchars($_POST['address']);
        $password = htmlspecialchars($_POST['pwd']);
        $password_retype = htmlspecialchars($_POST['confirmpwd']);

        $demandeId = $bdd->query('SELECT COUNT(utilisateur_id) AS UNB FROM utilisateurs');
        $supId = $demandeId->fetch();

        $imageFileType = strtolower(pathinfo($_FILES['imageID']['name'],PATHINFO_EXTENSION));
        $nbUser = $supId['UNB']+1;
        $photo = $nbUser.'.'.$imageFileType;
        $chemin = 'image/photo/'.$photo;
        $charge=move_uploaded_file($_FILES['imageID']['tmp_name'], $chemin);


        $check = $bdd->prepare('SELECT email, password FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();


        if($row == 0){
                if(strlen($email) <= 100){
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        if($password == $password_retype){

                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);



                            /*
                                Pour ceux qui souhaite mettre en place un système de mot de passe oublié, pensez à mettre le champ token dans votre requête
                                $insert = $bdd->prepare('INSERT INTO utilisateurs(pseudo, email, password, ip, token) VALUES(:pseudo, :email, :password, :ip, :token)');
                                $insert->execute(array(
                                    'pseudo' => $pseudo,
                                    'email' => $email,
                                    'password' => $password,
                                    'ip' => $ip,
                                    'token' =>  bin2hex(openssl_random_pseudo_bytes(24))
                                ));
                              */

                            $insert = $bdd->prepare('INSERT INTO utilisateurs(Nom, Prenom, Profession, Pays, Ville, Email, Phone, Date_N, Occupation, Statut, Sexe, Address, Password, Photo )
                            VALUES(:Nom, :Prenom, :Profession, :Pays, :Ville, :Email, :Phone, :Date_N, :Occupation,
                              :Statut,
                               :Sexe, :Address, :Password, :Photo)');
                            $insert->execute(array(
                                'Nom' => $name,
                                'Prenom' =>$surname,
                                'Profession' =>$profession,
                                'Pays' =>$pays,
                                'Ville' =>$city,
                                'Email' =>$email,
                                'Phone' =>$phone,
                                'Date_N' =>$DateN,
                                'Occupation' =>$occupation,
                                'Statut' =>$statut,
                                'Sexe' =>$sexe,
                                'Address' =>$address,
                                'Password' =>$password,
                                'Photo' =>$photo
                            ));

                            header('Location: registe.php?reg_err=success'); die();
                        }else{ header('Location: registe.php?reg_err=password'); die();}
                    }else{ header('Location: registe.php?reg_err=email'); die();}
                }else{ header('Location: registe.php?reg_err=email_length'); die();}
        }else{ header('Location: registe.php?reg_err=already'); die();}
    }
