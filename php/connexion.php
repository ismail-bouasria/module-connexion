<?php

// connexion à la base de données moduleconnexion
$bdd = mysqli_connect('localhost','root','','moduleconnexion');
 
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
               header('location: index.php');
            }else { // si le mot de passe est faux alors :
                echo 'Connexion impossible, le mot de passe est incorrecte.';
            }
            // si on on appui sur deconnexion alors :
           
        }else {
            echo 'Connexion impossible, le login est incorrecte.';
        }
     }else {
         echo 'connexion impossible, login et/ou mot de passe non renseignés ';
     }
    
 } 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
   
CONNEXION
<form action="" method="post">
Login: <input type="text" name="login" />
Mot de Passe : <input type="password" name="password"/>
<input type="submit" name="submit" value="Se connecter"/>
</form>
</body>
</html>