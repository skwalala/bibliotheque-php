<?php
include("index.php");
include("connexion_bdd.php");

$r_oeuvre="SELECT titre, noOeuvre, idAuteur,dateParution
from OEUVRE
ORDER BY titre;";
$oeuvres = $bdd->query($r_oeuvre);
$data = $oeuvres->fetchAll();

?>
<div class="row">
	<table border="2">
		<caption>Recapitulatifs des Oeuvres</caption>
			<thead>
			<tr><th>titre de l'oeuvre</th><th>identifiant auteur</th><th>date de parution</th></tr>
			</thead>
			<tbody>
			<?php foreach ($data as $value): ?>
				<tr><td>
						<?php echo $value['titre']; ?>
					</td><td>
						<?php echo $value['idAuteur']; ?>
					</td><td>
						<?php echo $value['dateParution']; ?>
					</td><td>
						<a href="Oeuvre_edit.php?id=<?= $value['noOeuvre'];?>">modifier</a>
					</td><td>
						<a href="Oeuvre_edit.php?id=<?= $value['noOeuvre'];?>">supprimer</a>
					</td>
				</tr>
			<?php endforeach; ?>
			<tbody>
	</table>
</div>

