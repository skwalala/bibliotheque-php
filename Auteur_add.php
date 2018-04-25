<?php
include('index.php');
include("connexion_bdd.php");
if(isset($_POST["name"]) AND isset($_POST["nickname"]))
{
        $donnees['name']=$_POST["name"];
        $donnees['nickname']=$_POST['nickname'];
        $ma_requete_SQL="INSERT INTO AUTEUR (idAuteur, nomAuteur, prenomAuteur) VALUES (NULL,'".$donnees['name']."','".$donnees['nickname']."');";
        print_r($ma_requete_SQL);
        $bdd->exec($ma_requete_SQL);
        header("Location: Auteur_show.php");
}

?>

<form action="Auteur_add.php" method="post">
  <fieldset>
	<label for="name"> nom :</label>
	<input id="name" type ="text" name="name">
	<label for="nickname"> prenom :</label>
	<input id="nickname" type="text" name="nickname">
	<input id="ajouter" type="submit" name="ajouter" value="ajouter">
  </fieldset>
</form>
