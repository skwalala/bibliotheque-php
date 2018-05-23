<?php
include('index.php');
include("connexion_bdd.php");
if(isset($_POST["titre"]) AND isset($_POST["dateParution"]) AND isset($_POST["idAuteur"]))
{
	$donnees['titre']=$_POST["titre"];
	$donnees['dateParution']=htmlentities($_POST['dateParution']);
	$donnees['idAuteur']=htmlentities($_POST['idAuteur']);

	$ma_requete_SQL="INSERT INTO OEUVRE (noOeuvre, titre, dateParution, idAuteur) VALUES (NULL,'".$donnees['titre']."','".$donnees['dateParution']."','".$donnees['idAuteur']."');";
	print_r($ma_requete_SQL);
	$bdd->exec($ma_requete_SQL);
	header("Location: Oeuvre_show.php");
}

?>

<form action="Oeuvre_add.php" method="post">
<div class="row">
  <fieldset>
  	<legend>Ajouter une Oeuvre</legend>
	<label for="titre"> Titre :</label>
	<input id="titre" type ="text" name="titre">
	<label for="dateParution"> date de parution :</label>
	<input id="dateParution" type="date" name="dateParution">
	<label for="idAuteur">Auteur :</label><br>
      <select name="idAuteur" id="idAuteur" >
          <?php
          $cat = $bdd->query("SELECT idAuteur,nomAuteur FROM AUTEUR;");
          $donnee = $cat->fetchAll();

          foreach ($donnee as $categorie){
              $string="<option value='".$categorie['idAuteur']."'>".$categorie['nomAuteur'];
              $string=$string."</option>";
              echo $string;
          }?>
      </select>
	<input id="ajouter" type="submit" name="ajouter" value="ajouter">
  </fieldset>
</div>
</form>
