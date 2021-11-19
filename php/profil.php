<?php
// Conditions de sessions ouvertes
session_start();
if (isset($_SESSION["username"])) {
    echo "Bienvenue  ".$_SESSION["username"];
  if (isset($_POST['deconect'])) {
    session_destroy();
    header('location:connexion.php');
}
// connexion à la base de données moduleconnexion
$bdd = mysqli_connect('localhost','root','','moduleconnexion');

// Requête pour recuperer les données dans moduleconnexion
$sessionlog=$_SESSION["username"];
$req = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='$sessionlog'");
$result= mysqli_fetch_all($req,MYSQLI_ASSOC);

//CONDITION D'EDITION :
  if (isset($_POST['edit'])){
    $login = $_POST['login'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $password = $_POST['password'];
    $confpass = $_POST['password2'];
    //requête pour recuperer le login déjà 
    $req2= mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='$login'");
    $result2= mysqli_fetch_all($req2,MYSQLI_ASSOC);
    var_dump($result,$_SESSION);
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
}else {
    echo 'nardine mouk connecte toi';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <header>

  </header>
    <main>
        <?php 
        if (isset($_SESSION["username"])) {
            echo '
          <form action="" method="post">
          Login : <input type="text" name="login" value="'.$result[0]['login'].'" />
          Nom: <input type="text" name="prenom" value ="'.$result[0]['nom'].'"/>
          Prenom: <input type="text" name="nom" value ="'.$result[0]['prenom'].'"/>
          Mot de Passe : <input type="password" name="password"/>
          Confirmation du mot de passe : <input type="password" name="password2"  />
          <input type="submit" name="edit" value="Editer"/>
          <input type="submit" name="deconect" value="Déconnexion">
          </form>'; 
        }
   ?>
    </main>
</body>
</html>



