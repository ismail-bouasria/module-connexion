<?php
// connexion à la base de données moduleconnexion
$bdd = mysqli_connect('localhost','root','','moduleconnexion');

if (isset($_POST['submit'])){
// Requête pour recuperer les données dans moduleconnexion
    $login = $_POST['login'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $password = $_POST['password'];
    $confpass = $_POST['password2'];
    $req = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='$login'");
    $result= mysqli_fetch_all($req); // recuperer les donnée
    // Condition d'inscription
    // si les champs du formulaire ne sont pas vide.
    if (!empty($login) && !empty($prenom) && !empty($nom) && !empty($password) && !empty($confpass)) { 
      if(empty($result)){
        // si la confirmation du mot de passe est identique au mot de passe:
        if ($confpass == $password) { 

              mysqli_query($bdd,"INSERT INTO utilisateurs ( `login`, `prenom`, `nom`, `password`) VALUES ('$login','$prenom','$nom','$password')");
            }
    // Si la confirmation du mot de passe est mauvaise :
        else {echo "Inscription impossible, Erreure dans la confirmation du mot de passe";}
       }// Si le login est déjà utilisé :
       else {echo 'Inscription impossible,Le login est déjà utilisé';}
// Si l'un des champs ou tous sont vides :
    }else { echo 'Inscription impossible, remplissez tous les champs.'; }
}
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
<header>
    <section>
         <li>Accueil</li>
    <li>Profil</li>
    </section>
   

</header>
<form action="" method="post">

Login: <input type="text" name="login" />
Nom: <input type="text" name="prenom" />
Prenom: <input type="text" name="nom" />
Mot de Passe : <input type="password" name="password"/>
Confirmation du mot de passe : <input type="password" name="password2"  />
<input type="submit" name="submit" value="S'inscrire"/>
</form>

    
</body>
</html>