<?php
include('index.php');
include("connexion_bdd.php");


error_reporting(E_ALL);
ini_set('display_errors', '1');

if(isset($_GET['idAdherent']) AND isset($_GET['noExemplaire']) AND isset($_GET['idAdherent']) AND is_numeric($_GET['noExemplaire']))
{
	$id=htmlentities($_GET['idAdherent']);
	$exemplaire=htmlentities($_GET['noExemplaire']);
	$ma_requete_SQL="DELETE FROM EMPRUNT WHERE idAdherent = ".$id." AND noExemplaire=".$exemplaire.";";
	$bdd->exec($ma_requete_SQL);

	header("Location: Emprunt_show.php");
}

?>