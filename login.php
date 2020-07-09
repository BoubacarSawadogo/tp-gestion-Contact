<?php
session_start();

if (isset($_GET['logout']) && $_GET['logout']) {
    session_destroy();
} elseif (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $password = $_POST['password'];

    $db = db_connection();

    $requete = $db->query('SELECT userPassword, userName FROM tp_user');
    while ($data = $requete->fetch()) {
        $data_password = $data['userPassword'];
        $data_username = $data['userName'];

        if (password_verify($password, $data_password)) {
            $_SESSION['user_name'] = $user;
            header('Location: index.php');
        } else {
            header('Location: login.php');
        }
    }
}

function db_connection()
{
    $dbServerName = 'programmation-web-3.org';
    $dbUserName = 'root';
    $dbPassword = '';
    $dbName = 'programmationweb3';
    $mysqli = new PDO('mysql:host=programmation-web-3.org; dbname=programmationweb3;charset=utf8', 'root', '');

    if (mysqli_connect_errno()) {
        echo 'Erreur de connection au serveur MySQL: ('.$mysqli->connect_errno.') '.$mysqli->connect_error;
        exit;
    }

    return $mysqli;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>login</title>
</head>

<body>
    <br><br>
    <div class="container">
        <div class="jumbotron">
            <h1>Login</h1>
            <p class="lead">L'usager par defaut est <strong>userName:admin</strong> et
                <strong>password:admin</strong>
            </p>
            <hr>
            <form method="post" action="index.php?action=login">
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Username" name="userName">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="inputPassword" name="password"
                            placeholder="Password">
                    </div>
                </div>


                <button type="submit" class="btn btn-secondary" name="login">login</button>

            </form>
        </div>

    </div>
</body>

</html>