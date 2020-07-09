<?php

function update($id, $prenom, $nom, $courriel, $userName, $Modification, $password = null)
{
    $password = password_hash($password, PASSWORD_DEFAULT);

    $update = "update tp_user set firstName = '$prenom' ,lastName = '$nom',email='$courriel',userName='$userName'".($password ? ",
    userPassword ='".password_hash($password, PASSWORD_DEFAULT)."'" : '').",modificationDate = '$Modification' where id= '$id';";
    $varStatus = '';
    $mysqli = mysqli_connect('programmation-web-3.org', 'root', '', 'ProgrammationWeb3');
    mysqli_set_charset($mysqli, 'utf8');
    if (mysqli_connect_errno()) {
        echo 'Erreur de connection au serveur MySQL: ('.$mysqli->connect_errno.') '.$mysqli->connect_error;
        exit;
    }

    if (mysqli_query($mysqli, $update)) {
        $status = 'vous avez reussi!';
    } else {
        $varStatus = 'errur!   '.mysqli_error($mysqli);
    }

    mysqli_close($mysqli);

    return $varStatus;
}
