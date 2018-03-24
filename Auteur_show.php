<?php
// connexion à la base de données : 
// création d'une instance d'un objet PDO de nom $bdd
include("connexion_bdd.php");
// traitement :
// test si on soumet un formulaire ou pas
// test si il y a des paramètres dans L’URL
// en fonction des tests, exécution de requête(s) SQL
// en fonction des tests et des résultats des requêtes SQL, création de variables, tableaux associatifs ...
// éventuellement redirection

// affichage de la vue
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Titre du site</title>
</head>
<body>
    <?php
    
    $auteurs = $bdd->query('SELECT nomAuteur, prenomAuteur FROM AUTEUR');
    $donnees = $auteurs->fetchAll();

    foreach ($donnees as $auteur){
	echo $auteur['prenomAuteur'].", ".$auteur['nomAuteur']."<br>";
    }
    
    echo " affichage des données" ?>
</body>
</html>
