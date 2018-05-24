<?php
include("index.php");
include("connexion_bdd.php");

error_reporting(E_ALL);
ini_set('display_errors', '1');

$r_oeuvre="SELECT titre, noOeuvre, idAuteur,dateParution
from OEUVRE
ORDER BY titre;";
$oeuvres = $bdd->query($r_oeuvre);
$data = $oeuvres->fetchAll();


?>

<a href="Oeuvre_add.php">ajouter une oeuvre</a>

<div class="row">
	<table border="2">
		<caption>Recapitulatifs des Oeuvres</caption>
			<thead>
			<tr><th>titre de l'oeuvre</th><th>identifiant auteur</th><th>date de parution</th><th>nmb exemplaire</th><th>nmb exemplaire dispo</th><th>exemplaires</th><th>operations</th></tr>
			</thead>
			<tbody>
			<?php foreach ($data as $value):
                $noOeuvre=$value['noOeuvre'];
                $r_exemplaire="SELECT COUNT(*)
                from EXEMPLAIRE
                WHERE noOeuvre=$noOeuvre;";
                $result = $bdd->query($r_exemplaire);
                $nmbExemplaire = $result->fetch();
			?>

				<tr><td>
						<?php echo $value['titre']; ?>
					</td><td>
						<?php echo $value['idAuteur']; ?>
					</td><td>
						<?php echo $value['dateParution']; ?>
					</td><td>
                        <?php echo $nmbExemplaire['COUNT(*)']; ?>
                    </td><td>
                        <?php //echo $value3['nmbExemplaireDispo']; ?>
                    </td><td>
						<a href="Exemplaire_show.php?idOeuvre=<?= $value['noOeuvre']; ?>">Gérer Exemplaires</a>
					</td><td>
						<a href="Oeuvre_edit.php?idAuteur=<?= $value['idAuteur'];?>&titre='<?= $value['titre'];?>'&date=<?= htmlentities($value['dateParution']); ?>&id=<?= $value['noOeuvre'];?>">modifier</a>
						<a href="Oeuvre_delete.php?id=<?= $value['noOeuvre'];?>">supprimer</a>
					</td>
				</tr>
			<?php endforeach; ?>
			<tbody>
	</table>
</div>

