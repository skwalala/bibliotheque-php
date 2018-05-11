<?php
include('index.php');
include("connexion_bdd.php");

if(isset($_GET["id"]) AND is_numeric($_GET["id"]))
{
	$id=htmlentities($_GET['id']);
	$check_requette="SELECT *FROM EXEMPLAIRE WHERE noOeuvre =".$id.";";
	$result=$bdd->query($check_requette);
	$result=$result->fetchAll();
	if(empty($result)){

		$ma_requete_SQL="DELETE FROM OEUVRE WHERE noOeuvre = ".$id.";";
		$bdd->exec($ma_requete_SQL);
		header("Location: Oeuvre_show.php");

	}else{
		echo "attention, il reste des exemplaires a supprimer <br>";
		echo "<a href='Oeuvre_show.php'>revenir en arrière</a><br>";
	}
}

?>
