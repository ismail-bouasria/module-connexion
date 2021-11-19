<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF8">

    <Title>Accueil</Title>
    <link rel="stylesheet" href=".//asset/css/module-connexion.css">
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>

<body>
   
    <Header class="Icolor">
        <section class="center">
            <a href="index.php"><img src=".//asset/images/Islogo.png" alt="Logo La Plateforme "></a>
            
</section>

         <!-- MENU -->
        <div class="dimtext">
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <?php
                       if (isset($_SESSION['username'])) {
                          
                          echo'<li>
                          <form action="index.php" method="post">
                          <input type="submit" name="deconect" value="Déconnexion"/>
                          </form>
                          </li>
                          <li><a href="./php/profil.php">Profil</a></li>';
                         } 
                     else {
                        echo'<li><a href="./php/inscription.php">Inscription</a></li>
                        <li><a href="./php/connexion.php">Connexion</a></li>';
                        }
                    if (isset($_POST['deconect'])) {
                            session_destroy();
                            header("location:index.php");
                            }
                    
                    
                    
                    <li><a href=".//php/profil.php">Admin</a></li>
                    ?>
                </ul>
            </nav>
        </div>
    </Header>

    
    <!-- FORMULAIRE -->

   
    
 
    <!-- TEXTES -->
    <main style="background-color: #ffffff;">
        <div class="divflex">
            <div class="colortext2" ; style="background-color:#ffffff;">
                <br>

                <h1>Une autre question ?</h1>
                <ul>Nous sommes aussi joignables :</ul>
                <br>
                <ul>– Email &nbsp;<a href="mailto:contact@laplateforme.io">contact@laplateforme.io</a></ul>
                <ul>– Téléphone: 04.84.89.43.69 du Lundi-Vendredi de 9h à 17h</ul>
                <ul>– Réseaux sociaux</ul>

                <ul><a href="https://www.facebook.com/LaPlateformeIO" target="_blank"><img src="fb.png" alt="Facebook"></a>&nbsp;
                    <a href="https://www.linkedin.com/company/laplateformeio" target="_blank"><img src="linkedin.png" alt="Linkdedin"></a>&nbsp;
                    <a href="https://twitter.com/LaPlateformeIO" target="_blank"><img src="twitter.png" alt="Twitter"></a>&nbsp;
                    <a href="https://www.instagram.com/LaPlateformeIO" target="_blank"><img src="insta.png" alt="Instagram"></a>
                </ul>
                <br>
            </div>
        </div>
    </main>
    <div class="divflex" ; style="background-color:#ffffff;">
        <div class="bigtext">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h1><a href="https://laplateforme.io/laplateforme_brochure.pdf" target="_blank">
                    Télécharger notre brochure !</a> &nbsp;
        </div>
        <div><a href="https://laplateforme.io/laplateforme_brochure.pdf" target="_blank"><img src="brochure.jpg" alt="brochure"></a></div>
    </div>
    <br>
    <!-- CARTES -->
    <div class="divflex">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2903.4558253108085!2d5.367935414649636!3d43.304716482914195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12c9c13ddc0211b9%3A0xd1642ae4b32c4bc4!2sEcole%20La%20Plateforme%2C%20le%20Campus%20M%C3%A9diterran%C3%A9en%20du%20Num%C3%A9rique!5e0!3m2!1sfr!2sfr!4v1633637418496!5m2!1sfr!2sfr" width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <br>
    <!-- PIED DE PAGE -->
    <footer style="background-color: rgb(34, 34, 34);">
        <br>
        <div class="flexcolortext">
            <div>Association Loi 1901 - SIRET : 84160956300025</div>
            <div>Tel : 04.84.89.43.69 - contact@laplateforme.io
            </div>
            <div>© La Plateforme_. Tous droits réservés.</div>
        </div>
    </footer>

</body>

</html>