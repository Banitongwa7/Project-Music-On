<?php
include ("database_connection.php");

?>


<!DOCTYPE html>
<html lang="fr">

<head>

  <!-- Site réaliser par : BANITONGWA DAVID et OMARI OMARI KAYUMBA -->
  
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Boostrap -->
  <link rel="stylesheet" href="CSS/bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />

  <!-- Fichier css -->
  <link rel="stylesheet" href="CSS/styles2.css" />

  <!-- Icone logo dans le header -->
  <link rel="icon" href="IMAGES/logo/icone_musicon.svg"/>
  
  <!-- Site web des musiques libre -->
  <title>Music ON</title>

  <style>
  @media screen and (max-width: 992px) 
  {
  .ppl{
    margin-left: 10px ;
  }
  }
  .d-flex div
  {
      padding: 5px;
  }

  .d-flex a
  {
      color: rgb(0, 0, 0);
  }
    

/* Style css pied de la page */

.footer-dark {
    padding: 60px 0;
    color: #f0f9ff;
    background-color: #282d32;
  }

  .footer-dark h3 {
    margin-top: 0;
    margin-bottom: 12px;
    font-weight: bold;
    font-size: 16px;
  }

  .footer-dark ul {
    padding: 0;
    list-style: none;
    line-height: 1.6;
    font-size: 14px;
    margin-bottom: 0;
  }

  .footer-dark ul a {
    color: white;
    text-decoration: none;
    opacity: 0.7;
  }

  .footer-dark ul a:hover {
    opacity: 0.8;
  }

  .footer-dark .item.text {
    margin-bottom: 36px;
  }

  .footer-dark .item.text p {
    opacity: 0.6;
    margin-bottom: 0;
  }

  .footer-dark .item.social {
    text-align: center;
  }

  .footer-dark .item.social a {
    font-size: 20px;
    width: 36px;
    height: 36px;
    line-height: 36px;
    display: inline-block;
    text-align: center;
    border-radius: 50%;
    box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.4);
    margin: 0 8px;
    color: #fff;
    opacity: 0.75;
  }

  .footer-dark .item.social a:hover {
    opacity: 0.9;
  }

  .footer-dark .signat {
    text-align: center;
    padding-top: 24px;
    opacity: 0.3;
    font-size: 13px;
    margin-bottom: 0;
  }

  .part-social {
    margin-top: 10px;
    margin-bottom: -30px;
  }

  @media (max-width:991px) {
    .footer-dark .item.social {
      text-align: center;
      margin-top: 20px;
    }
  }

  @media (max-width:767px) {
    .footer-dark .item:not(.social) {
      text-align: center;
      padding-bottom: 20px;
    }
  }

  @media (max-width:767px) {
    .footer-dark .item.text {
      margin-bottom: 0;
    }
  }

  </style>
</head>

<body>
  <!-- Barre dans le header -->
  <nav class="navbar navbar-expand-lg navbar-light arplan">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="IMAGES/logo/logo_transparent.svg" alt="logo music on" class="logo1" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item ppl">
            <a class="nav-link" href="HTML/gallery_music.php?page=1">Playlist</a>
          </li>

        </ul>
        <div class="d-flex">
          <?php
          if (isset($_SESSION["admin_id"]))
          {
            ?>
            <div>
            <a href="#"> <?=getName($connect,$_SESSION["admin_id"])?> </a>|
            </div>
            <div>
              <a href="HTML/logout.php">Se deconnecter</a>
            </div>
            <?php
      
          }
          else
          {
            ?>
            <div>
            <a href="HTML/inscription.php">S'inscrire </a>|
            </div>
            <div>
              <a href="HTML/login.php">Se connecter</a>
            </div>
            <?php
          }
          ?>
          
        </div>
      </div>
    </div>
  </nav>
  

  <!-- image first -->
  <div class="imag_arr">
    <div class="texte_first">
      <p class="text1">Ecouter la musique</p>
      <p class="text2">Sans limitte</p>
    </div>
    <div class="ecouter">
      <a href="HTML/gallery_music.php?page=1"><button type="button">Commencez à ecouter</button></a>
    </div>
  </div>

 <!--Pied de la page -->
<div class="footer-dark">
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-3 item">
            <h3>Contact</h3>
            <ul>
              <li><a href="mailto:musicon_enterprise@outlook.com">Nous envoyer un mail</a></li>
              <li>Tel : +216 54482172</li>
              <li>Lieu : Ariana Tunis</li>
            </ul>
          </div>
          <div class="col-sm-6 col-md-3 item">
            <h3>A Propos de nous</h3>
            <ul>
              <li><a href="#"></a></li>
              <li><a href="#">Music ON</a></li>
              <li><a href="#">Nos partenaires</a></li>
            </ul>
          </div>
          <div class="col-sm-6 item text">
            <h3>S'inscrire au Newsletter</h3>
            <form action="index.php" method="post">
              <div class="input-group mb-3">
                <input type="email" class="form-control" name="champnews" placeholder="Votre adresse E-mail">
                <button class="btn btn-info" type="submit" id="button-addon2" name="news" >Envoyer</button>
              </div>
            </form>
          </div>
        </div>
        <div class="row part-social">
          <div class="item part social">
            <a href="https://soundcloud.com/" target="_blank" title="SoundCloud"><img src="IMAGES/icone/soundcloud.svg" alt="soundcloud" class="icon"></a>
            <a href="https://fr-fr.facebook.com/" target="_blank" title="Facebook"><img src="IMAGES/icone/facebook.svg" alt="facebook" class="icon"></a>
            <a href="https://www.spotify.com/fr/" target="_blank" title="Spotify"><img src="IMAGES/icone/spotify.svg" alt="spotify" class="icon"></a>
            <a href="https://www.youtube.com/" target="_blank" title="Youtube"><img src="IMAGES/icone/youtube.svg" alt="youtube" class="icon"></a>
          </div>
          <p class="signat">Developper par DAVID et OMARI - 2021</p>
        </div>
      </div>
    </footer>
  </div>

  <script src="CSS/bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>
</body>

</html>
