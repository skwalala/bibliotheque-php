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
<a href="Auteur_add.php">ajouter un auteur</a>
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
    
    $auteurs = $bdd->query('SELECT AUTEUR.idAuteur, nomAuteur, prenomAuteur, count(noOeuvre) as count 
    FROM AUTEUR 
    LEFT JOIN OEUVRE 
    ON AUTEUR.idAuteur=OEUVRE.idAuteur 
    GROUP by AUTEUR.idAuteur 
    ORDER BY nomAuteur;');
    $donnees = $auteurs->fetchAll();

    foreach ($donnees as $auteur){
    	echo "<tr>";
	echo "<td>".$auteur['nomAuteur']."</td><td>".$auteur['prenomAuteur']."</td><td>".$auteur['count']."</td><td><a href='Auteur_edit.php?auteur=".$auteur['idAuteur']."'>modifier</a> <a href='Auteur_delete.php?auteur=".$auteur['idAuteur']."'>supprimer</a></td>";
	echo "</tr>";
    }
    ?>
    	</tbody>
</table>   
</body>
</html>
