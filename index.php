<?php
session_start();
// connexion à la base de données moduleconnexion
$bdd = mysqli_connect('localhost','root','','moduleconnexion');
// Requête pour se connecter
$req = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='admin'");
$result= mysqli_fetch_all($req,MYSQLI_ASSOC); // recuperer les données de l'admin.

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./asset/css/module-connexion.css">
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <title>Accueil </title>
</head>
<body>
    <header>
      <section  >
          <img class="headsize"src="./asset/images/Nulogo.jpg" alt="NintendoUnivers.logo">
      </section>
      <!-- MENU -->
      <nav>
        <section class="menuflex">
            <section class="menucard"><a href="index.php">Accueil</a></section> 
            <!-- PHP  CONDITIONS DE CONNEXIONS -->
            <?php
                       if (isset($_SESSION['username'])) {
                        if (isset($_POST['deconect'])) {
                            session_destroy();
                            header("location: index.php");
                            }       ?>
                    <section class="menucard"> <form class="deco" action="" method="post">
                            <input  type="submit" name="deconect" value="Déconnexion" />
                                      </form>
                    </section>
                    <?php }
                         else {
                    ?><section class="menucard">
                        <a href="./php/inscription.php">Inscription</a>
                    </section> 
            <section class="menucard">
                <a href="./php/connexion.php">Connexion</a>
            </section>
            <?php } ?>
            <?php 
            if (isset($_SESSION['username'])) {?>
                  <section class="menucard"><a href="./php/profil.php">Profil</a></section>
      <?php }
            if (isset($_SESSION['username'])) {
                // je vérifie si le pseudo est identique à admin.
                if ($_SESSION["username"] == $result[0]['login']) {?>
            <section class="menucard"><a href="./php/admin.php">Admin</a></section>
            <?php } 
            }
            ?>
            
        </section>
      </nav>
    </header>
    <main>
<section class="container"> 
    <section class="card1">
      <div><h1>DERNIERS ARTICLES</h1></div>
      <section class="flex">
          <div class="articlecard1"> 
          <img class="artimg" src="./asset/images/newsimage1.png" alt="" srcset="">
          </div>
          <div class="articlecard2"> 
            <h3>Evenement – Le Tokyo Game Show 2020 numérique se déroulera du 23 au 27 septembre</h3>
            <p> COVID-19 – C’est au tour du Tokyo Game Show d’annoncer son annulation à cause de la pandémie de Covid-19. Le monde de l’événementiel s’organise pour poursuivre son activité sous la forme d’événements numériques.   </p>
          </div>
      </section>
      <section class="flex">
          <div class="articlecard1"> 
          <img class="artimg" src="./asset/images/newsimage2.png" alt="" srcset="">
          </div>
          <div class="articlecard2"> 
               <h3>Pokemon Presents – Le MOBA Pokémon Unite se dévoile ! </h3>
                <p>POKEMON – Un premier Pokémon Presents a été l’occasion pour les joueurs de découvrir plusieurs nouveaux projets de The Pokemon Company. Une nouvelle diffusion a hier présenté Pokémon Unite.   Quelle surprise pour les joueurs ! </p>
            </div>
      </section>
      <section class="flex">
          <div class="articlecard1"> 
<img class="artimg" src="./asset/images/newsimage3.png" alt="" srcset="">
          </div>
          <div class="articlecard2"> 
             <h3>Tetris99 – Le 14eme Grand Prix célèbre la sortie de Xenoblade Chronicles Definitive Edition ! </h3>
              <p>TETRIS® 99 – Le Tetris Battle Royal exclusif aux adhérents du service Nintendo Switch Online accueillera prochainement un nouvel événement ! Xenoblade Chronicles sera à l’honneur.   TETRIS® 99 a depuis sa sortie l’habitude de proposer des événements en collaboration avec d’autres jeux. </p>
          </div>
      </section>
    </section>
    <section class="card2">
        <div>
            <h1>DERNIERS TEST</h1>
        </div>
        <div class="testcard">
          <img class="artimg" src="./asset/images/test1.jpg" alt="test1">
          <h3>  Isolarmure, première partie du DLC de Pokémon Épée-Bouclier ! </h3>
        </div>
        <div class="testcard">
        <img class="artimg" src="./asset/images/test2.jpg" alt="test2">
        <h3> 51 Worldwide Games, le coffret de jeux à emporter ! </h3>
        </div>
        <div class="testcard">
        <img class="artimg" src="./asset/images/test3.jpg" alt="test3">
        <h3> 911 Operator Deluxe Edition – Entrez dans le quotidien des opérateurs d’appel d’urgence ! </h3>
        </div>
    </section>
</section>

    </main>
    <footer>
 <section class="footcard"> 
<h1>SITE</h1>
 </section>
 <section class="footcard"> 
 <h1>CATÉGORIES</h1>    
 </section>
 <section class="footcard"> 
 <h1>RÉSEAUX SOCIAUX</h1>
 </section> 
    </footer>
</body>
</html>