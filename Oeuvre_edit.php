<?php
include('index.php');

include("connexion_bdd.php");
if(isset($_POST["titre"]) AND isset($_POST["dateParution"]) AND isset($_POST["idAuteur"]) AND isset($_POST['id']))
{
        $donnees['titre']=htmlentities($_POST["titre"]);
        $donnees['dateParution']=htmlentities($_POST['dateParution']);
        $donnees['idAuteur']=htmlentities($_POST['idAuteur']);

        $ma_requete_SQL="UPDATE OEUVRE SET titre='".$donnees['titre']."', dateParution='".$donnees['dateParution']."', idAuteur='".$donnees['idAuteur']."' WHERE noOeuvre=".$_POST['id'].";";
        print_r($ma_requete_SQL);
        $bdd->exec($ma_requete_SQL);
        header("Location: Oeuvre_show.php");
}




if (!isset($_GET['titre']) OR !isset($_GET['idAuteur']) OR !isset($_GET['date']) AND !isset($_POST['id'])){
//header("Location: Oeuvre_show.php");
}else{
$id=$_GET['id'];
$titre=$_GET['titre'];
$idAuteur=$_GET['idAuteur'];
$date=$_GET['date'];
?>
<form action="Oeuvre_edit.php" method="post">
<div class="row">
  <fieldset>
  	<legend>editer une Oeuvre</legend>
	<label for="titre"> titre :</label>
	<input id="titre" type="text" name="titre" value=<?php echo $titre;?>>
	<label for="dateParution"> date :</label>
	<input id="dateParution" type="date" name="dateParution" value=<?php echo $date;?>>
	<label for="idAuteur"> id de l'Auteur :</label>
      <select name="idAuteur" id="idAuteur" >
          <?php
          $cat = $bdd->query("SELECT idAuteur,nomAuteur FROM AUTEUR;");
          $donnee = $cat->fetchAll();

          foreach ($donnee as $categorie){
              if (intval($idAuteur) == intval($categorie['idAuteur'])){
                  $string = "<option value='" . $categorie['idAuteur'] . "' selected>" . $categorie['nomAuteur'];
                  $string = $string . "</option>";
              }else {
                  $string = "<option value='" . $categorie['idAuteur'] . "'>" . $categorie['nomAuteur'];
                  $string = $string . "</option>";
              }
              echo $string;
          }?>
      </select>
	<input id="id" name="id" type="hidden" value=<?php echo $id; ?>>
	<input id="modifier" type="submit" name="modifier" value="modifier">
  </fieldset>
</div>
</form>
<?php
}
