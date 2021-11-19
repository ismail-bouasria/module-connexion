<?php
session_start();
// connexion à la base de données moduleconnexion
$bdd = mysqli_connect('localhost','root','','moduleconnexion');
// Requête pour se connecter
$req = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='admin'");
$result= mysqli_fetch_all($req,MYSQLI_ASSOC); // recuperer les données de la base
if (isset($_SESSION["username"] )) {
   if ($_SESSION["username"] == $result[0]['login']) {
       echo ' vous êtes connecté';
   } else {
       echo ' vous ne disposez pas des droits pour afficher les informations de la page.';
   }

}

else {
    echo 'Vous n\'êtes pas connecté.';
}




?>