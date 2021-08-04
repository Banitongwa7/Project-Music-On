<?php
include ("../database_connection.php");

if (isset($_GET["id_delete"]))
{
  $delete = $_GET["id_delete"];
  delete_id($connect,$delete);
  echo "<script>location.href='interface_admin.php'</script>";
}
//Recuperation des valeurs dans la database
// musique
$query="select * from musique";
$statement = $connect->prepare($query);
$statement->execute();
$result1 = $statement->fetchAll();
$compt=0;
$compt2=0;
$compt3=0;
foreach ($result1 as $row)
{
  $compt++;
}

//client
$query="select * from Utilisateur";
$statement = $connect->prepare($query);
$statement->execute();
$result2 = $statement->fetchAll();

foreach ($result2 as $row)
{
  $compt2++;
}

//newsletter
$query="select * from abonne_newsletter";
$statement = $connect->prepare($query);
$statement->execute();
$result3 = $statement->fetchAll();

foreach ($result3 as $row)
{
  $compt3++;
}

if(isset($_POST["enregistrer"]))
{
  $titre = $_POST["titre"];
  $date = get_date();
  $cate = $_POST["catego"];
  $image = $_FILES["image"]["name"];
  $audio = $_FILES["audio"]["name"];
  $tmpname = $_FILES["image"]["tmp_name"];
  $tmpaudio = $_FILES["audio"]["tmp_name"];

  $extension_array = explode(".", $image);
  $extension = strtolower($extension_array[1]);
  $allowed_extension = array('jpg','png');

  // verification et chargement image

  if(!in_array($extension, $allowed_extension))
  {
    echo "<p>Format invalide</p>";
  }
  else
  {
    $image_name = uniqid().'.'.$extension;
    $upload_path = '../IMAGES/image_player/'.$image_name;
    move_uploaded_file($tmpname, $upload_path);
  }

  // verification et chargement audio

  $extension_audio = explode(".", $audio);
  $extension_mp3 = strtolower($extension_audio[1]);
  $allowed_audio = array('mp3','wav','m4a');

  if(!in_array($extension_mp3, $allowed_audio))
  {
    echo "<p>Format invalide</p>";
  }
  else
  {
    $music_name = uniqid().'.'.$extension_mp3;
    $upload_path_audio = '../MUSIC/'.$music_name;
    move_uploaded_file($tmpaudio, $upload_path_audio);
  }

  //Envoi dans la database

  $query = "INSERT INTO musique (titre,dateajout,categorie,audio,image) values(?,?,?,?,?)";
  $statement = $connect->prepare($query);
  $statement->execute(array($titre,$date,$cate,$music_name,$image_name));

}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boostrap -->
    <link rel="stylesheet" href="../CSS/bootstrap-5.0.0-beta3-dist/css/bootstrap.css" />

    <link rel="stylesheet" href="style_admin.css">
    <link rel="icon" href="../IMAGES/logo/icone_musicon.svg">
    <title>Espace admin - MusicON</title>
</head>

<body>

    <!-- Barre dans le header -->
    <nav class="navbar navbar-expand-lg navbar-light arplan">
        <div class="container-fluid">
            <a class="navbar-brand" href="interface_admin.php">
                <img src="../IMAGES/logo/logo_transparent.svg" alt="logo music on" class="logo1" />
            </a>

            <div class="navbar-collapse">
                <div class="d-flex">
                        <p>Administrateur</p>
                        <img src="../IMAGES/icone/bootstrap-icons-1.4.1/person.svg" alt="user" class="user">
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-md-4 tab">
        <h4> <a href="#tabmus">Total musique</a></h4>
        <p class="tabp"><?=$compt?></p>
        </div>
        <div class="col-md-4 tab">
        <h4> <a href="#tabclient">Total client</a></h4>
        <p class="tabp"><?=$compt2?></p>
        </div>
        <div class="col-md-4 tab">
        <h4> <a href="#tababonne">Total E-mail newsletter</a></h4>
        <p class="tabp"><?=$compt3?></p>
        </div>
      </div>
</div>

    <section class="container f1">
        <h3>Formulaire de la musique</h3>
        <form class="row g-3" action="interface_admin.php" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
              <label for="inputEmail4" class="form-label">Titre</label>
              <input type="text" class="form-control" name="titre" id="inputEmail4">
            </div>

            <div class="col-mb-3">
              <label for="imgf" class="form-label">Charger l'image de la musique</label>
              <input class="form-control" type="file" name="image" id="imgf">
            </div>

            <div class="col-mb-3">
              <label for="audf" class="form-label">Charger la musique</label>
              <input class="form-control" type="file" name="audio" id="audf">
            </div>

            <div class="col-md-4">
              <label for="inputCategorie" class="form-label">Categorie</label>
              <select id="inputCategorie" name="catego" class="form-select">
                <option selected>...</option>
                <option value="Motivational Music">Motivational Music</option>
                <option value="Epic Music">Epic Music</option>
                <option value="Happy Music">Happy Music</option>
                <option value="Inspirational Music">Inspirational Music</option>
              </select>
            </div>

            <div class="col-12">
              <button type="submit" name="enregistrer" class="btn btn-info">Enregistre</button>
            </div>
          </form>
    </section>



    <section class="container f1" id="tabmus">
    <h3>Liste des musiques enregistrées</h3>
    <table class="table">
    <thead>
      <tr>
        <th scope="col">ID musique</th>
        <th scope="col">Titre</th>
        <th scope="col">Date d'Ajout</th>
        <th scope="col">Categorie</th>
        <th scope="col">Fichier Audio</th>
        <th scope="col">Fichier image</th>
        <th scope="col">Operation</th>
      </tr>
    </thead>
  <tbody>
  <?php
  foreach($result1 as $row)
  {
  ?>
    <tr>
      <th scope="row"><?=$row["id_musique"]?></th>
      <td><?=$row["titre"]?></td>
      <td><?=$row["dateajout"]?></td>
      <td><?=$row["categorie"]?></td>
      <td> <audio src="../MUSIC/<?= $row["audio"] ?>" controls></audio></td>
      <td> <img src="../IMAGES/image_player/<?=$row["image"]?>" alt=" " width="80" ></td>
      <td><a href="interface_admin.php?id_delete=<?=$row["id_musique"] ?>" class="btn btn-danger">Supprimer</a></td>
    </tr>
  <?php
  }
  ?>
  </tbody>
</table>
</section>


<section class="container f1" id="tabclient">
    <h3>Liste des clients</h3>
    <table class="table">
    <thead>
      <tr>
        <th scope="col">ID User</th>
        <th scope="col">Nom</th>
        <th scope="col">Prenom</th>
        <th scope="col">Telephone</th>
        <th scope="col">Email</th>
      </tr>
    </thead>
  <tbody>
  <?php
  foreach($result2 as $row)
  {
  ?>
    <tr>
      <th scope="row"><?=$row["Id_user"]?></th>
      <td><?=$row["nom_user"]?></td>
      <td><?=$row["prenom_user"]?></td>
      <td><?=$row["telephone_user"]?></td>
      <td><?= $row["email_user"] ?></td>
    </tr>
  <?php
  }
  ?>
  </tbody>
</table>
</section>


<section class="container f1" id="tababonne">
    <h3>Liste des abonnés au newsletter</h3>
    <table class="table">
    <thead>
      <tr>
        <th scope="col">ID Abonne</th>
        <th scope="col">Email</th>
      </tr>
    </thead>
  <tbody>
  <?php
  foreach($result3 as $row)
  {
  ?>
    <tr>
      <th scope="row"><?=$row["id_abonne"]?></th>
      <td><?= $row["email_abonne"] ?></td>
    </tr>
  <?php
  }
  ?>
  </tbody>
</table>
</section>

</body>

</html>