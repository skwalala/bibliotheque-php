<?php
include("index.php");
include("connexion_bdd.php");

$r_exemplaire="SELECT noExemplaire, noOeuvre, etat ,dateAchat, prix
from EXEMPLAIRE
WHERE noOeuvre =".$_GET['idOeuvre']."
ORDER BY noExemplaire;";
$exemplaire = $bdd->query($r_exemplaire);
$data = $exemplaire->fetchAll();

?>

<a href="Exemplaire_add.php">ajouter un Exemplaire</a>

<div class="row">
	<table border="2">
		<caption>Recapitulatifs des Oeuvres</caption>
			<thead>
			<tr><th>id exemplaire</th><th>id oeuvre</th><th>etat</th><th>dateAchat</th><th>prix</th><th>emprunt</th><th>operations</th></tr>
			</thead>
			<tbody>
			<?php foreach ($data as $value): ?>
				<tr><td>
						<?php echo $value['noExemplaire']; ?>
					</td><td>
						<?php echo $value['noOeuvre']; ?>
					</td><td>
						<?php echo $value['etat']; ?>
					</td><td>
						<?php echo $value['dateAchat']; ?>
					</td><td>
						<?php echo $value['prix']; ?>
					</td><td>
						<a href="Emprunt_show.php?noExemplaire=<?= $value['noExemplaire']; ?>">Gérer Emprunt</a>
					</td><td>
						<a href="Exemplaire_edit.php?noExemplaire=<?= $value['noExemplaire'];?>&noOeuvre=<?=$value['noOeuvre'];?>&etat=<?=$value['etat']; ?>&dateAchat=<?= htmlentities($value['dateAchat']);?>&prix=<?=$value['prix']?>?>">modifier</a>
                                                  <a href="Exemplaire_delete.php?id=<?= $value['noExemplaire'];?>&idOeuvre=<?= $value['noOeuvre']?>">supprimer    </a>

					
					</td>
				</tr>
			<?php endforeach; ?>
			<tbody>
	</table>
</div>

