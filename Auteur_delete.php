<?php
include('connexion_bdd.php');
include('index.php');
if (!isset($_GET['auteur'])){
echo "go to index";
}else{
$idAuteur=$_GET['auteur'];
$r_oeuvre="SELECT * 
FROM OEUVRE
WHERE idAuteur=".$idAuteur.";";

$oeuvres=$bdd->query($r_oeuvre);
$data=$oeuvres->fetchAll();
if (!empty($data)){
	echo "il reste des oeuvres à supprimer avant de supprimer cet auteur : <br>";
	foreach($data as $oeuvre){
		echo $oeuvre['titre']." : <a href=Oeuvre_delete.php?oeuvre=".$oeuvre['noOeuvre'].">supprimer</a><br>";
	}
}else{
$r_delete_auteur="DELETE FROM AUTEUR 
WHERE idAuteur=".$idAuteur.";";
$bdd->exec($r_delete_auteur);
echo "auteur supprimé";
}
}
