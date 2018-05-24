<?php
include('index.php');
include("connexion_bdd.php");

if(isset($_GET['idAdherent']) AND is_numeric($_GET['idAdherent']))
{
	$id=htmlentities($_GET['idAdherent']);
	$ma_requete_SQL="DELETE FROM EMPRUNT WHERE idAdherent = ".$id.";";
	$bdd->exec($ma_requete_SQL);

	header("Location: Emprunt_show.php");
}

?>