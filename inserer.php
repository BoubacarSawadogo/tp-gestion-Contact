<?php

$dbServerName = 'localhost';
$dbUserName = 'root';
$dbPassword = '';
$dbName = 'programmationweb3';

function inserer($prenom, $nom, $courriel, $userName, $password, $Creation, $Modification)
{
    $password = password_hash($password, PASSWORD_DEFAULT);

    $querry = "insert INTO tp_user (firstName, lastName,email,userName,userPassword,creationDate,modificationDate) VALUES('".$prenom."', '".$nom."','".$courriel."','".$userName."','".$password."','".$Creation."','".$Modification."');";

    $varStatus = '';

    $mysqli = mysqli_connect('programmation-web-3.org', 'root', '', 'ProgrammationWeb3');

    mysqli_set_charset($mysqli, 'utf8');

    if (mysqli_connect_errno()) {
        echo 'Erreur de connection: ('.$mysqli->connect_errno.') '.$mysqli->connect_error;
        exit;
    }

    if (mysqli_query($mysqli, $querry)) {
        $varStatus = 'vous avez reussi!';
    } else {
        $varStatus = 'Erreur! '.mysqli_error($mysqli);
    }

    mysqli_close($mysqli);

    return $varStatus;
}
