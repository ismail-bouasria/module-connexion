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
    <link rel="stylesheet" href="../asset/css/module-connexion.css">
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <title>Connexion</title>
</head>
<body>
    <header>
      <section  >
          <img class="headsize"src="../asset/images/Nulogo.jpg" alt="NintendoUnivers.logo">
      </section>
      <!-- MENU -->
      <nav>
        <section class="menuflex">
            <section class="menucard"><a href="../index.php">Accueil</a></section> 
            <!-- PHP  CONDITIONS -->
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
                        <a href="inscription.php">Inscription</a>
                    </section> 
            <section class="menucard">
                <a href="connexion.php">Connexion</a>
            </section>
            <?php } ?>
            <?php 
            if (isset($_SESSION['username'])) {?>
                  <section class="menucard"><a href="profil.php">Profil</a></section>
      <?php }
            if (isset($_SESSION['username'])) {
                // je vérifie si le pseudo est identique à admin.
                if ($_SESSION["username"] == $result[0]['login']) {?>
            <section class="menucard"><a href="admin.php">Admin</a></section>
            <?php } 
            }
            ?>
            
        </section>
      </nav>
    </header>
    <main>
      
    <div class="containconnect">
        <div class="cardconnect">
        
         <!-- FORMULAIRE DE CONNEXION -->
            
            <form   action="" method="POST">
                <h1>Connexion</h1>
                
                <div class="padding">
                    <label><b>Login</b></label>
                </div>
                <div> 
                    <input type="text" placeholder="Entrer le login d'utilisateur" name="login" required>
                </div>

                <div class="padding">
                    <label><b>Mot de passe</b></label>
                </div>
                <div> 
                    <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                </div>

                <div class="padding"> 
                    <input type="submit" id='submit' name="submit" value='CONNEXION' > 
                </div> 
                <?php
               //conditions de Connexion :
               if (isset($_POST['submit'])) {
                $login = $_POST['login'];
                $password = $_POST['password'];
                // Requête pour se connecter
                $req = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='$login'");
                $result= mysqli_fetch_all($req,MYSQLI_ASSOC); // recuperer les données de la base
                // si le mot de passe et le login sont renseignés
                if (!empty($login) && !empty($password)) {
                     // si le login existe :
                     if (!empty($result)) {
                         // Si le mot de passe existe :
                         if ($result[0]['password'] == $password) {
                             session_start();
                             $_SESSION["username"] = $result[0]['login'];
                              header('location: ../index.php');
                           }else { // si le mot de passe est faux alors :
                               echo 'Connexion impossible, le mot de passe est incorrecte.';
                           }
                           // si on on appui sur connexion alors :
  
                       }else {
                              echo 'Connexion impossible, le login est incorrecte.';
                           }
                   }else {
                         echo 'Veuillez renségner votre login et mot de passe. ';
                       }
             } 
                ?>
            </form>
        </div>
    </div>
            
    </main>
    <footer>
 <section class="footcard"> 
<h1>SITE</h1>
<img  width="50%" src="https://pbs.twimg.com/profile_images/1186034419678797824/RkpbGOoM_400x400.jpg" alt="">
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