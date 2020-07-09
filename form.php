<?php
include 'functions.php';
//include 'index.php';
include 'update.php';
include 'inserer.php';
$user = ['firstName' => '', 'lastName' => '', 'email' => '', 'userName' => ''];
$urlLogout = '?logout=>disconnect';
$Modification = date('Y-m-d h:i:s');

if (isset($_GET['id'])) {
    $user = recupererLutilisateur($_GET['id']);
} else {
    if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['courriel']) && isset($_POST['userName'])) {
        if (isset($_POST['id'])) {
            if (isset($_POST['password'])) {
                update($_POST['id'], $_POST['prenom'], $_POST['nom'], $_POST['courriel'], $_POST['userName'], $Modification, $_POST['password']);
            } else {
                update($_POST['id'], $_POST['prenom'], $_POST['nom'], $_POST['courriel'], $_POST['userName'], $Modification);
            }
        } else {
            inserer($_POST['prenom'], $_POST['nom'], $_POST['courriel'], $_POST['userName'], $_POST['password'], date('Y-m-d h:i:s'), $Modification);
        }
        header('location: index.php');
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <nav class='navbar navbar-expand-sm navbar-dark bg-dark'>
            <a class="navbar-brand mb-0 h1" href="./">MySQL User Form</a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href='form.php'>Ajouter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php?logout=true">Logout</a>
                </li>
            </ul>
        </nav>
        <form action="form.php" method="post">
            <div class="form-group row">
                <label for="prenom" class="col-sm-2 col-form-label">Prenom</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="prenom" name="prenom"
                        value='<?=$user['firstName']; ?>'>
                </div>
            </div>
            <div class="form-group row">
                <label for="nom" class="col-sm-2 col-form-label">Nom</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nom" name="nom"
                        value='<?=$user['lastName']; ?>'>
                </div>
            </div>
            <div class="form-group row">
                <label for="courriel" class="col-sm-2 col-form-label">Courriel</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="courriel" name="courriel"
                        value='<?=$user['email']; ?>'>
                </div>
            </div>
            <div class="form-group row">
                <label for="userName" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="userName" name="userName"
                        value='<?=$user['userName']; ?>'>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <?php if (isset($_GET['id'])):  ?>

                    <input type="hidden" name='id'
                        value='<?= $_GET['id']; ?>'>
                    <?php endif; ?>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>