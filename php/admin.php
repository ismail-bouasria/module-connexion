

<?php
session_start();
// connexion à la base de données moduleconnexion
$bdd = mysqli_connect('localhost','root','','moduleconnexion');
// Requête pour se connecter
$req = mysqli_query($bdd,"SELECT * FROM utilisateurs" );
$result = mysqli_fetch_all($req,MYSQLI_ASSOC);

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
                            header("location:../index.php");
                            }       ?>
                    <section class="menucard"> <form action="" method="post">
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
   <?php if (isset($_SESSION["username"] )) {
   if ($_SESSION["username"] == "admin") {?>
        <div class="containtable">
        
        <table>
           <thead>
            <tr>
             <?php
            foreach ($result as $value) {
                foreach ($value as $key => $value2) {
                    echo'<th>'.$key.'</th>';
                    
              
                }
                break;
            }
             ?>
           </tr>
          </thead>
           </tr>
            <tbody>
    
       <?php
     
            foreach ($result as $value) {
                echo "<tr>";
                foreach ($value as $key => $value2) {
                    echo' <td>'.$value2.'</td>';
                    
              
                }
               echo ' </tr>';
            }
         ?>
       
          
      
    </tbody>
    </table>
    </div> 
     <?php  
   } else {?>
       <div class="textcust">
           <h1> Vous ne disposez pas des droits pour afficher les informations de la page!</h1>
        </div>
   <?php }

}

else { ?>
    <div class="textcust"> 
        <h1>Vous n'êtes pas connecté!</h1></div>
    <?php
}
?>
      
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