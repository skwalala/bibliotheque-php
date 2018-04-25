<?php
include('index.php');
include("connexion_bdd.php");
if(isset($_POST["name"]) AND isset($_POST["nickname"]))
{
        $donnees['name']=htmlentities($_POST["name"]);
        $donnees['nickname']=htmlentities($_POST['nickname']);
        $ma_requete_SQL="UPDATE AUTEUR SET nomAuteur='".$donnees['name']."', prenomAuteur='".$donnees['nickname']."' WHERE idAuteur=".$_POST['idAuteur'].";";
        print_r($ma_requete_SQL);
        $bdd->exec($ma_requete_SQL);
        header("Location: Auteur_show.php");
}

?>
<form action="Auteur_edit.php" method="post">
  <fieldset>
	<label for="name"> nom :</label>
	<input id="name" type ="text" name="name" value=<?php echo $_GET['nom']?>>
	<label for="nickname"> prenom :</label>
	<input id="nickname" type="text" name="nickname" value=<?php echo $_GET['prenom']?>>
	<input id="idAuteur" type="hidden" name="idAuteur" value=<?php echo $_GET['auteur']; ?>>
	<input id="modifier" type="submit" name="modifier" value="modifier">
  </fieldset>
</form>
