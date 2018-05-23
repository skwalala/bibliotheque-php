<?php
// connexion à la base de données : 
// création d'une instance d'un objet PDO de nom $bdd
include("connexion_bdd.php");
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
    <title>Recapitulatifs des Emprunts</title>
</head>
<body>
<center>Recapitulatif des Emprunts</center>
<table class="tableau-emprunts" border="2">
	<thead>
		<td>
			<b>nom Adherent</b>
		</td>
		<td>
			<b>titre</b>
		</td>
		<td>
			<b>date emprunt</b>
		</td>
		<td>
			<b>dateRendu</b>
		</td>
		<td>
			<b>Exemplaires<b>
		</td>
		<td>
			<b>retard<b>
		</td>
		<td>
			<b>opérations</b>
		</td>
	
	</thead>
	<tbody>
    <?php
    
    $cemprunt = $bdd->query('SELECT ADHERENT.idAdherent,EXEMPLAIRE.noExemplaire,OEUVRE.titre,nomAdherent,dateEmprunt,dateRendu
    	, DATEDIFF(curdate(),dateEmprunt) as nbJoursEmprunt
    	, DATEDIFF(curdate(),DATE_ADD(dateEmprunt, INTERVAL 90 DAY)) as RETARD
    	, DATE_ADD(dateEmprunt, INTERVAL 90 DAY) as dateRenduTheorique
    	, IF(CURRENT_DATE()>DATE_ADD(dateEmprunt, INTERVAL 90 DAY),1,0) as flagRetard
    	, IF(CURRENT_DATE()>DATE_ADD(dateEmprunt, INTERVAL 120 DAY),1,0) as flagPenalite
    	, IF( ((DATEDIFF(curdate(),DATE_ADD(dateEmprunt, INTERVAL 120 DAY)) * 0.5)<25),
    		(DATEDIFF(curdate(),DATE_ADD(dateEmprunt, INTERVAL 120 DAY)) * 0.5),25) as dette
    	FROM ADHERENT
    	JOIN EMPRUNT ON EMPRUNT.idAdherent=ADHERENT.idAdherent
    	JOIN EXEMPLAIRE ON EMPRUNT.noExemplaire=EXEMPLAIRE.noExemplaire
    	JOIN OEUVRE ON EXEMPLAIRE.noOeuvre = OEUVRE.noOeuvre
    	WHERE dateRendu is NULL
    	HAVING flagRetard=1;
    ;');
    $donnees = $cemprunt->fetchAll();
    var_dump($donnees);

    foreach ($donnees as $emprunt){
    	echo "<td>".$emprunt['nomAdherent']."</td><td>".$emprunt['titre']."</td><td>".$emprunt['dateEmprunt']."</td><td>".$emprunt['dateRendu']."</td><td>".$emprunt['noExemplaire']."</td>";
		echo "<td>";
		echo"</td>";
		?>
		<td>
			<a href="Emprunt_edit.php?idAdherent=<?=$emprunt['idAdherent']; ?>&noExemplaire=<?=$emprunt['noExemplaire']; ?>&dateEmprunt=<?=$emprunt['dateEmprunt']; ?>&dateRendu=<?=$emprunt['dateRendu'];?>">modifier</a>
			<a href="Emprunt_delete.php?id=<?=$emprunt['idAdherent'];?>">supprimer</a>
		</td>
	</tr>
    <?php } ?>
</tbody>
</table>
</body>
</html>
