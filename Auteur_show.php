<?php
// connexion à la base de données : 
// création d'une instance d'un objet PDO de nom $bdd
include("connexion_bdd.php");
include("v_head.php");
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
<table class="tableau-auteur">
	<thead>
		<td>
			nom
		</td>
		<td>
			prenom
		</td>
		<td>
			nombre d'oeuvres
		</td>
		<td>
			opérations
		</td>



	</thead>
	<tbody>
    <?php
    
    $auteurs = $bdd->query('SELECT idAuteur, nomAuteur, prenomAuteur, count(noOeuvre) as count 
    FROM AUTEUR 
    LEFT JOIN OEUVRE 
    ON AUTEUR.idAuteur=OEUVRE.idAuteur 
    GROUP by AUTEUR.idAuteur 
    ORDER BY nomAuteur;');
    $donnees = $auteurs->fetchAll();

    foreach ($donnees as $auteur){
    	echo "<tr>";
	echo "<td>".$auteur['nomAuteur']."</td><td>".$auteur['prenomAuteur']."</td><td>".$auteur['count']."</td><td><a href='Autheur_edit.php'>modifier</a> <a href='Autheur_delete.php'>supprimer</a></td>";
	echo "</tr>";
    }
    ?>
    	</tbody>
</table>   
</body>
</html>
