<?php include_once 'functions.php';
session_start();

// modiff
/*if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
}*/

if (isset($_GET['logout']) && $_GET['logout']) {
    session_destroy();
}

// delete
if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    supprimer($_GET['id']);
}

if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $userName = $_POST['userName'];
    $userPassword = $_POST['userPassword'];

    $hashed = password_hash($userPassword, PASSWORD_DEFAULT);

    $mysqli->query("INSERT INTO tp_user (firstName, lastName, email, userName, userPassword) VALUES ('$firstName',
'$lastName', '$email', '$userName', '$hashed');");
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/fef1c58bfd.js"></script>
    <style>

    </style>
</head>

<body><br><br>
    <div class="container">

        <table class="table table-bordered able table-sm table-hover">

            <nav class="navbar navbar-dark bg-dark col-sm-12">
                <span class="navbar-brand text-white">MySQl User Form <a class="navbar-brand text-dark"
                        href="#">options</a> <a class="navbar-brand text-white-50" href="form.php">Ajouter</a></span>
            </nav>

            <tr>

                <th>Prenom</th>
                <th>Nom</th>
                <th>Courriel</th>
                <th>Date de creation</th>
                <th>Date de modification</th>

            </tr>
            <tbody>
                <?=remplirTableau(); ?>
            </tbody>
            </tr>
        </table>

    </div>

</body>

</html>