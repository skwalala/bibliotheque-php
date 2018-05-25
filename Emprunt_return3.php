<?php
include('index.php');
include("connexion_bdd.php");

error_reporting(E_ALL);
ini_set('display_errors', '1');

if(isset($_GET['idAdherent']) AND isset($_GET['noExemplaire'])){
	$donnees['dateRendu']=$date = date('Y-m-d', time());
	$donnees['idAdherent']=$_GET['idAdherent'];
	$donnees['noExemplaire']=$_GET['noExemplaire'];

	$ma_requete_SQL="UPDATE EMPRUNT SET dateRendu = '".$donnees['dateRendu']."' WHERE idAdherent = '".$donnees["idAdherent"]."' AND idAdherent = '".$donnees["noExemplaire"]."';";
		print_r(($ma_requete_SQL));
    	$bdd->exec($ma_requete_SQL);
    	header("Location: Emprunt_return.php");
}
?>