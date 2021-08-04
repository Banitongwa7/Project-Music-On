<?php
include ("../database_connection.php");
if (isset($_POST["envoyer"]))
{
    $nom = $_POST["nom_user"];
    $prenom = $_POST["prenom_user"];
    $email = $_POST["email_user"];
    $numero = $_POST["numero_user"];
    $motdepasse = $_POST["pass_user"];
    $confirme = $_POST["conf_user"];
    $erreur = false;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $erreur = true;
    }
    if ($motdepasse != $confirme)
    {
        $erreur = true;
    }
    if ($erreur == false)
    {
        $query = " INSERT INTO Utilisateur (nom_user, prenom_user, telephone_user, email_user, motdepasse_user)
        VALUES (?,?,?,?,?)";
        $statement = $connect->prepare($query);
        $statement -> execute(array($nom,$prenom,$numero,$email,password_hash($motdepasse, PASSWORD_DEFAULT)));
        header("location:login.php");
    }

}

?>


<!DOCTYPE html>
<html lang="fr">
<head>

    <!-- Site réaliser par : BANITONGWA DAVID -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boostrap -->
    <link rel="stylesheet" href="../CSS/bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css">

    <!-- Fichier css -->
    <link rel="stylesheet" href="../CSS/styles.css">

    <link rel="icon" href="../IMAGES/logo/icone_musicon.svg" />

    <!-- Site web des musiques libre -->
    <title>Music ON</title>

     <!-- Modification Boostrap -->
    <style>
        .form-group , button
        {
            margin-top: 15px;
        }

        .content
        {
            margin: 6%;
            border-radius: 2px;
            background-color: white;
            padding: 4px 1px 4px 10px;
            box-shadow: 0 0 5px 5px rgba(0, 0, 0, 0.24);
        }
        .signin-text
        {
            font-style: normal;
            font-weight: 600;
        }

        .form-control
        {
            display: block;
            width: 100%;
            font-size: 13px;
            line-height: 1.6;
            font-weight: 400;
            border-color: #00ac96;
            color: #495057;
            height: auto;
            border-radius: 8px;
            background-color: white;
            padding: 3px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class=" row content">
        <div class="col-md-6 mb-3">
            <img src="../IMAGES/logo/logo_transparent.svg" class="img-fluid" alt="logo" id="monlogo">
        </div>

        <div class="col-md-6 connect_rg">
            <h3 class="signin-text mb-3">S'inscrire</h3>
            <form action="inscription.php" method="post">
                    <div class="form-group">
                        <label for="nom_user" >Nom</label>
                        <input type="text" name="nom_user" class="form-control" maxlength="15" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom_user" >Prénom</label>
                        <input type="text" name="prenom_user" class="form-control" maxlength="15" required>
                    </div>
                    <div class="form-group">
                        <label for="email_user" >Email</label>
                        <input type="email" name="email_user" class="form-control" title="Exemple : abc14@exemple.com">
                    </div>
                    <div class="form-group">
                        <label for="numero_user" >Numero de téléphone</label>
                        <input type="tel" name="numero_user" class="form-control" title="exemple : +1008599674">
                    </div>
                    <div class="form-group">
                        <label for="pass_user" >Mot de passe</label>
                        <input type="password" name="pass_user" class="form-control" title="Le mot de passe doit avoir 8 ou plus des caracteres" >
                    </div>
                    <div class="form-group">
                        <label for="conf_user" >Confirmer votre mot de passe</label>
                        <input type="password" name="conf_user" class="form-control">
                    </div>
                    <button type="submit" class="btn btn_connect" name="envoyer" >Valider</button>
            </form>
        </div>

    </div>
</div>

</body>
</html>
