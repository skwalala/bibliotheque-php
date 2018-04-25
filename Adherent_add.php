<?php
include('index.php');
include("connexion_bdd.php");
if(isset($_POST["nom"]) AND isset($_POST["adresse"]) AND isset($_POST["datePaiement"]))
{
	$donnees['nom']=$_POST["nom"];
	$donnees['adresse']=htmlentities($_POST['adresse']);
	$donnees['datePaiement']=htmlentities($_POST['datePaiement']);

	$ma_requete_SQL="INSERT INTO ADHERENT (idAdherent, nomAdherent, adresse, datePaiement) VALUES (NULL,'".$donnees['nom']."','".$donnees['adresse']."','".$donnees['datePaiement']."');";
	print_r($ma_requete_SQL);
	$bdd->exec($ma_requete_SQL);
	header("Location: Adherent_show.php");
}

?>

<form action="Adherent_add.php" method="post">
<div class="row">
  <fieldset>
  	<legend>Ajouter un Adherent</legend>
	<label for="nom"> Nom </label>
	<input id="nom" type ="text" name="nom">
	<label for="adresse"> adresse </label>
	<input id="adresse" type="text" name="adresse">
	<label for="datePaiement"> date de paiement </label>
	<input id="datePaiement" type="date" name="datePaiement">
	<input id="ajouter" type="submit" name="ajouter" value="ajouter">
  </fieldset>
</div>
</form>
