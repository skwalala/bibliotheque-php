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
    <title>Liste des adherents</title>
</head>
<body>
<a href='Adherent_add.php'>Ajouter un adherent</a>
<br>
<center>Recapitulatif des Adherents</center>
<table class="tableau-adherent" border="2">
	<thead>
		<td>
			<b>nom</b>
		</td>
		<td>
			<b>adresse</b>
		</td>
		<td>
			<b>datePaiement</b>
		</td>
		<td>
			<b>information</b>
		</td>
		<td>
			<b>opérations</b>
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
	echo "<td>";
	if ($donnees_emprunt['dates'] > 0) {
		echo "".$donnees_emprunt['dates']."emprunt(s) en cours";	
	}
	$curDate = date_create(date("Y-m-d"));
	$paiementDate = date_create($adherent['datePaiement']);

	if ( $paiementDate ->diff($curDate)->days >= 365) {
		echo "<br>";
		echo "paiement en retard depuis : ";
		$dateDePaiement = $paiementDate->format('Y-m-d');
		$paiementDateEnRetard = date("Y-m-d", strtotime(date("Y-m-d", strtotime($dateDePaiement)) . " + 1 year"));
		echo $paiementDateEnRetard;
	}
	if (($paiementDate ->diff($curDate)->days <= 365) && ($paiementDate ->diff($curDate)->days >= 335)) {
		echo "<br>";
		echo "paiement à renouveller";
	}
	?>
	</td>
	<td>
		<a href="Adherent_edit.php?nomAdherent=<?= $adherent['nomAdherent'];?>&adresse=<?= htmlentities($adherent['adresse']); ?>&datePaiement=<?= $adherent['datePaiement'];?>&id=<?= $adherent['idAdherent'];?>">modifier</a>
		<a href="Adherent_delete.php?id=<?= $adherent['idAdherent'];?>">supprimer</a>
	</td>
	</tr>
    <?php } ?>
    	</tbody>
</table>   
</body>
</html>