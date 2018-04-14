<?php
include('index.php');
include("connexion_bdd.php");
if(isset($_POST["titre"]) AND isset($_POST["dateParution"]) AND isset($_POST["idAuteur"]))
{
	$donnees['titre']=$_POST["titre"];
	$donnees['dateParution']=htmlentities($_POST['dateParution']);
	$donnees['idAuteur']=htmlentities($_POST['idAuteur']);

	$ma_requete_SQL="INSERT INTO OEUVRE (noOeuvre, titre, dateParution, idAuteur) VALUES (NULL,'".$donnees['titre']."','".$donnees['dateParution']."','".$donnees['idAuteur']."');";
	print_r($ma_requete_SQL);
	$bdd->exec($ma_requete_SQL);
	header("Location: Oeuvre_show.php");
}

?>

<form action="Oeuvre_add.php" method="post">
<div class="row">
  <fieldset>
  	<legend>Ajouter une Oeuvre</legend>
	<label for="titre"> Titre :</label>
	<input id="titre" type ="text" name="titre">
	<label for="dateParution"> date de parution :</label>
	<input id="dateParution" type="date" name="dateParution">
	<label for="idAuteur"> Identifiant de l'Auteur :</label>
	<input id="idAuteur" type="text" name="idAuteur" value="1">
	<input id="ajouter" type="submit" name="ajouter" value="ajouter">
  </fieldset>
</div>
</form>
