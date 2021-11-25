<?php
session_start();
// connexion à la base de données moduleconnexion
$bdd = mysqli_connect('localhost','root','','moduleconnexion');
// Requête pour se connecter
$req = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='admin'");
$result= mysqli_fetch_all($req,MYSQLI_ASSOC); // recuperer les données de l'admin.
              //CONDITION D'EDITION :
              if (isset($_POST['edit'])){
                $login = $_POST['login'];
                $prenom = $_POST['prenom'];
                $nom = $_POST['nom'];
                $password = $_POST['password'];
                $confpass = $_POST['password2'];
               $sessionlog = $_SESSION['username'];
                //requête pour recuperer le login déjà 
                $req2= mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='$login'");
                $result2= mysqli_fetch_all($req2,MYSQLI_ASSOC);
                // si les champs du formulaire ne sont pas vide.
                if (!empty($login) && !empty($prenom) && !empty($nom)) { 
                    // je verifie si le login est déjà utilisé mais permettre de conserver le meme login.
                  if(empty($result2) || $result2[0]['login']== $sessionlog){
                    // si la confirmation du mot de passe est identique au mot de passe:
                    if ($confpass == $password) { 
            // requête qui edite les informations de l'utilisateurs
                          mysqli_query($bdd,"UPDATE `utilisateurs` SET `login`='$login',`prenom`='$prenom',`nom`='$nom',`password`='$password'WHERE login='$sessionlog'");
                          $_SESSION["username"] = $login;
                          header('location: #');
                        }
                // Si la confirmation du mot de passe est mauvaise :
                    else {echo "Edition impossible, Erreure dans la confirmation du mot de passe";}
                   }// Si le login est déjà utilisé :
                   else {
                       echo 'Edition impossible,Le login est déjà utilisé';}
            // Si l'un des champs ou tous sont vides :
                }else { echo 'Edition impossible, remplissez tous les champs.'; }
            }
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
                            header("location: ../index.php");
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
        <div class="cardconnect2">
        
         <!-- FORMULAIRE DU PROFIL  -->
         <?php 
        if (isset($_SESSION["username"])) {
             $users = $_SESSION["username"];
             $req3= mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='$users'");
               $result3= mysqli_fetch_all($req3,MYSQLI_ASSOC);
             ?>
            <form   action="" method="POST">
                <h1>PROFIL</h1>
                <div class="padding">
                    <label><b>Login</b></label>
                </div>
                <div> 
                    <input type="text" value="<?php echo $result3[0]['login']; ?>" name="login">
                </div>
                
                <div class="padding">
                    <label><b>Nom</b></label>
                </div>
                <div> 
                    <input type="text" value="<?php echo $result3[0]['nom']; ?>" name="nom">
                </div>
                <div class="padding">
                    <label><b>Prénom</b></label>
                </div>
                <div> 
                    <input type="text" value="<?php echo $result3[0]['prenom']; ?>" name="prenom">
                </div>
                <div class="padding">
                    <label><b>Mot de passe</b></label>
                </div>
                <div> 
                    <input type="password" placeholder="Mot de passe" name="password">
                </div>
                <div class="padding">
                    <label><b>Confirmation du mot de passe</b></label>
                </div>
                <div> 
                    <input type="text" placeholder="Confirmer le mot de passe" name="password2">
                </div>

                <div class="padding"> 
                    <input type="submit" id='submit' name="edit" value='Editer' > 
                </div> 
  <?php } ?>

                <?php


                ?>
            </form>
        </div>
    </div>
            
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

