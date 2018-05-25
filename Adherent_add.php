<?php
include('index.php');
include("connexion_bdd.php");
if(isset($_POST["nom"]) AND isset($_POST["adresse"]) AND isset($_POST["datePaiement"]))
{
	$donnees['nom']=$_POST["nom"];
	$donnees['adresse']=htmlentities($_POST['adresse']);
	$donnees['datePaiement']=htmlentities($_POST['datePaiement']);

	$erreurs = array();
	if (! preg_match("/^[A-Za-z ]{2,}/", $donnees['nom'])) $erreurs['nom'] = 'nom composé de 2 lettres minimum';
	if (! preg_match("/^[A-Za-z ]{2,}/", $donnees['adresse'])) $erreurs['adresse'] = 'adresse composé de 2 lettres minimum';
	//if (! preg_match("#^([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})$#", $donnees['datePaiement'],$matches)) $erreurs['datePaiement'] = 'la date doit être au format MM/JJ/AAAA';
	//else{
		//if(! checkdate($matches[1], $matches[2], $matches[3]))
		//	$erreurs['datePaiement'] = 'la date n\'est pas valide';
		//else
	//		$donnees['datePaiement_us'] = $matches[3]."-".$matches[2]."-".$matches[1];
	//}

	if (empty($erreurs)) {
		$ma_requete_SQL="INSERT INTO ADHERENT (idAdherent, nomAdherent, adresse, datePaiement) VALUES (NULL,'".$donnees['nom']."','".$donnees['adresse']."','".$donnees['datePaiement_us']."');";
		print_r($ma_requete_SQL);
		$bdd->exec($ma_requete_SQL);
		header("Location: Adherent_show.php");	
	}
	else
		$message="il y a des erreurs => réafficher la vue (formulaire avec les erreurs)";
}

?>

<form action="Adherent_add.php" method="post">
<div class="row">
  <fieldset>
  	<legend>Ajouter un Adherent</legend>
	<label for="nom"> Nom
		<input id="nom" type ="text" size="18" value="<?php if(isset($donnees['nom'])) echo $donnees['nom']; ?>" name="nom">
	</label>
	<?php if(isset($erreurs['nom'])) echo '<div class="alert alert-danger">'.$erreurs['nom'].'</div>'; ?>
	<label for="adresse"> adresse
		<input id="adresse" type="text" size="18" value="<?php if(isset($donnees['adresse'])) echo $donnees['adresse']; ?>" name="adresse">
	</label>
	<?php if(isset($erreurs['adresse'])) echo '<div class="alert alert-danger">'.$erreurs['adresse'].'</div>'; ?>
	<label for="datePaiement"> date de paiement
		<input id="datePaiement" type="date" size="18" value="<?php if(isset($donnees['datePaiement'])) echo $donnees['datePaiement']; ?>" name="datePaiement">
	</label>
	<?php if(isset($erreurs['datePaiement'])) echo '<div class="alert alert-danger">'.$erreurs['datePaiement'].'</div>'; ?>
	<input id="ajouter" type="submit" name="ajouter" value="ajouter">
  </fieldset>
</div>
</form>
