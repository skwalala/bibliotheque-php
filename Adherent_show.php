<?php
// connexion à la base de données : 
// création d'une instance d'un objet PDO de nom $bdd
include("connexion_bdd.php");
include("v_head.php");
include("index.php");
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
<table class="tableau-adherent">
	<thead>
		<td>
			nom
		</td>
		<td>
			adresse
		</td>
		<td>
			datePaiement
		</td>
		<td>
			information
		</td>
		<td>
			opérations
		</td>



	</thead>
	<tbody>
    <?php
    
    $radherent = $bdd->query('SELECT ADHERENT.idAdherent, ADHERENT.nomAdherent, ADHERENT.adresse, ADHERENT.datePaiement
    FROM ADHERENT
    ORDER BY ADHERENT.nomAdherent
    ;');
    $donnees = $radherent->fetchAll();

    foreach ($donnees as $adherent){
    	$emprunt = $bdd->query('SELECT COUNT(dateRendu) AS dates
    		FROM EMPRUNT
    		WHERE EMPRUNT.idAdherent = '.$adherent['idAdherent'].'
    		AND dateRendu LIKE "0000-00-00";');
    	$donnees_emprunt = $emprunt->fetch();
    	echo "<tr>";
	echo "<td>".$adherent['nomAdherent']."</td><td>".$adherent['adresse']."</td><td>".$adherent['datePaiement']."</td>";
	if ($donnees_emprunt['dates'] > 0) {
		echo "<td>".$donnees_emprunt['dates']."emprunt(s) en cours</td>";	
	} else {
		echo "<td></td>";
	}
	echo "<td><a href='Adherent_edit.php'>modifier</a> <a href='Adherent_delete.php'>supprimer</a></td>";
	echo "</tr>";
    }
    ?>
    	</tbody>
</table>   
</body>
</html>