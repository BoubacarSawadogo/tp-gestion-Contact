<?php

$dbServerName = 'localhost';
$dbUserName = 'root';
$dbPassword = '';
$dbName = 'programmationweb3';

function BD($requette)
{
    $mysqli = mysqli_connect('programmation-web-3', 'root', '', 'Programmation-web-3');

    $update = false;
    $name = '';
    $prenom = '';

    if (mysqli_connect_errno()) {
        echo 'Erreur de connection: ('.$mysqli->connect_errno.') '.$mysqli->connect_error;
        exit;
    }
    mysqli_set_charset($mysqli, 'utf8');
    $result = mysqli_query($mysqli, $requette);

    if (!$result) {
        $error = mysqli_error($mysqli);
        var_dump($error);
    }
    $users = [];
    while ($associativeArray = mysqli_fetch_assoc($result)) {
        array_push($users, $associativeArray);
    }

    mysqli_free_result($result);

    mysqli_close($mysqli);

    return $users;
}
function remplirTableau()
{
    $reponse = '';

    $requete = BD('select firstName,lastName,email,creationDate,modificationDate,id from tp_user');

    foreach ($requete as $ligne) {
        $reponse .= '<tr>';
        $variable = array_keys($ligne);
        $dernierecase = count($ligne) - 1;
        for ($i = 0; $i < $dernierecase; ++$i) {
            $reponse .= '<td>'.$ligne[$variable[$i]].'</td>';
        }
        $reponse .= '<td class="btn btn-primary bg-secondary"><a href=\'form.php? edit="" && id='.$ligne[$variable[$dernierecase]].'\'  class="btn btn-primary bg-secondary" name = "edit" ><i class="fas fa-pen-square" ></i> </a><a href=\'index.php? delete="" && id='.$ligne[$variable[$dernierecase]].'\' class="btn btn-primary bg-secondary" name = "delete" ><i class="fas fa-window-close"></i></a></td>';
        $reponse .= '</tr>';
    }
    /*  <a href="index.php?delete='' && id=<?php echo $user['id']; ?>"
          class="btn btn-primary bg-secondary" name="delete"><i class="fas fa-times"></i></a>*/

    return $reponse;
}
function supprimer($id)
{
    $mysqli = mysqli_connect('programmation-web-3.org', 'root', '', 'ProgrammationWeb3');

    if (mysqli_connect_errno()) {
        echo 'Erreur de connection au serveur MySQL: ('.$mysqli->connect_errno.') '.$mysqli->connect_error;
        exit;
    }

    mysqli_set_charset($mysqli, 'utf8');

    $result = mysqli_query($mysqli, 'delete from tp_user where id=\''.$id.'\'');

    if (!$result) {
        $error = mysqli_error($mysqli);
    }

    mysqli_close($mysqli);
}

/*

if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM tp_user where id ='$id'";
    $result = mysqli_query($mysqli, $sql);
    header('location: index.php');
}*/
function recupererLutilisateur($id)
{
    return BD('select firstName,lastName,email,userName from tp_user where id=\''.$id.'\'')[0];
}
