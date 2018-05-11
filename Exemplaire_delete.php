<?php
include('index.php');
include("connexion_bdd.php");

if(isset($_GET["id"]) AND is_numeric($_GET["id"]))
{
	$id=htmlentities($_GET['id']);
	$idOeuvre=htmlentities($_GET['idOeuvre']);
	$check_requette="SELECT * FROM EMPRUNT WHERE noExemplaire =".$id.";";
	$result=$bdd->query($check_requette);
	$result=$result->fetchAll();
	if(empty($result)){

		$ma_requete_SQL="DELETE FROM EXEMPLAIRE WHERE noExemplaire = ".$id.";";
		$bdd->exec($ma_requete_SQL);
		header("Location: Exemplaire_show.php?idOeuvre=$idOeuvre");
	}else{
		echo "attention, il reste des emprunt a supprimer<br>";
		echo "<a href='Exemplaire_show.php?idOeuvre=$idOeuvre'>revenir en arrière</a><br>";
	}
}

?>
