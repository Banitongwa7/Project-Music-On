<?php
include ("../database_connection.php");
if (isset($_SESSION["admin_id"]))
{
    echo "<script>location.href='../index.php'</script>";
}


if(isset($_POST["connect1"]))
{

$email = $_POST["mail"];
$pass = $_POST["pass"];
$test = 0;

$query="SELECT * FROM Utilisateur WHERE email_user =?";
$statement=$connect->prepare($query);
$statement->execute(array($email));
if ($statement->rowCount() > 0)
{
    $result=$statement->fetchAll();
    foreach($result as $row)
    {
        if(password_verify($pass,$row["motdepasse_user"]))
        {
            $_SESSION["admin_id"]=$row["Id_user"];
            header("location:../index.php");
        }
        else
        {
            $test = 1;
        }

    }
}
else
{
    $test = 1;
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

    .bi-facebook, .bi-google
    {
        margin-top: -5px;
    }

    .textincor{
        color: red;
    }
</style>
</head>

<body onload="document.f.mail.focus()">
<div class="container">
    <div class=" row content">
        <div class="col-md-6 mb-3">
            <img src="../IMAGES/logo/logo_transparent.svg" class="img-fluid" alt="logo" id="monlogo">
        </div>

        <div class="col-md-6 connect_rg">
            <h3 class="signin-text mb-3">Se connecter</h3>
            <form name="f" action="login.php" method="post">
                <div class="form-group">
                    <label for="mail" >E-mail</label>
                    <input type="email" name="mail" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="pass" >Mot de passe</label>
                    <input type="password" name="pass" class="form-control" required>
                </div>
                <?php
                if ($test == 1)
                {
                ?>
                <div class="form-group">
                    <p class="textincor">Mot de passe ou E-mail incorrect !</p>
                </div>
                <?php
                }
                ?>
                <div class="form-group">
                    <a href="inscription.php">Vous n'avez pas encore un compte ?</a>
                </div>
                <button type="submit" class="btn btn_connect" name="connect1" >Connection</button>
            </form>
            <hr>
            <div class="autre_mode">
                <p>Autre mode de connexion</p>
                <div class="ic_log">
                <a href="https://accounts.google.com/signin/v2/identifier?passive=1209600&continue=https%3A%2F%2Faccounts.google.com%2F&followup=https%3A%2F%2Faccounts.google.com%2F&flowName=GlifWebSignIn&flowEntry=ServiceLogin" target="popup" onclick="window.open('https://accounts.google.com/signin/v2/identifier?passive=1209600&continue=https%3A%2F%2Faccounts.google.com%2F&followup=https%3A%2F%2Faccounts.google.com%2F&flowName=GlifWebSignIn&flowEntry=ServiceLogin','popup','width=600,height=600');" class="google">
                    <img src="../IMAGES/icone/bootstrap-icons-1.4.1/google.svg" alt="icone google" class="bi bi-google" width="18" height="18"><span>Google</span>
                </a>
                <a href="https://fr-fr.facebook.com/login.php" target="popup" onclick="window.open('https://fr-fr.facebook.com/login.php','popup','width=600,height=600');" class="facebook">
                    <img src="../IMAGES/icone/bootstrap-icons-1.4.1/facebook.svg" alt="icone google" class="bi bi-facebook" width="18" height="18"><span>Facebook</span>
                </a>
                </div>

            </div>
        </div>

    </div>
</div>

</body>
</html>
