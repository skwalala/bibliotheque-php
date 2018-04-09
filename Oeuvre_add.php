<?php
include("index.php");
include("connexion_bdd.php");

if(isset($_POST["titre"]) AND isset($_POST["dateParution"]) AND isset([$_POST['idAuteur']))
{

	$donnees['titre']=$_POST['titre'];
	$donnees['dateParution']=htmlentities($_POST['dateParution']);
	$donnees['idAuteur']=htmlentities($_POST['idAuteur']);

	$requete="INSERT INTO OEUVRE (noOeuvre,titre,dateParution,idAuteur) VALUES (NULL, '".$donnes['titre']."','".$donnees['dateParution']."',".$donnees['idAuteur'].");";
	$bdd->exec($requete);
	header("Location: Oeuvre_show.php");

}


?>

<form method="post" action="Oeuvre_add.php">
	<div class="row">
		<fieldset>
			<legend>Ajouter une Oeuvre</legend>
			<label>Titre
				<input name="titre" type="text" size="18" value=""/>
			</label>
			<label>date de parution
				<input name="dateParution" type="text" size="18" value=""/>
			</label> 
			<label>identifiant de l'auteur
				<input name="idAuteur" type="text" size="18" value="1"/>
			</label>
			<input type="submit" name="AddOeuvre" value="ajouter une oeuvre" />
		</fieldset>
	</div>
</form>


