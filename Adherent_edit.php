<?php
include('index.php');

include("connexion_bdd.php");
if(isset($_POST["nomAdherent"]) AND isset($_POST["adresse"]) AND isset($_POST["datePaiement"]) AND isset($_POST['id']))
{
        $donnees['nomAdherent']=htmlentities($_POST["nomAdherent"]);
        $donnees['adresse']=htmlentities($_POST['adresse']);
        $donnees['datePaiement']=htmlentities($_POST['datePaiement']);

        $ma_requete_SQL="UPDATE ADHERENT SET nomAdherent='".$donnees['nomAdherent']."', adresse='".$donnees['adresse']."', datePaiement='".$donnees['datePaiement']."' WHERE idAdherent=".$_POST['id'].";";
        print_r($ma_requete_SQL);
        $bdd->exec($ma_requete_SQL);
        header("Location: Adherent_show.php");
}




if (!isset($_GET['nomAdherent']) OR !isset($_GET['adresse']) OR !isset($_GET['datePaiement']) AND !isset($_POST['id'])){
}else{
$id=$_GET['id'];
$adresse=$_GET['adresse'];
$datePaiement=$_GET['datePaiement'];
$nomAdherent=$_GET['nomAdherent'];
?>
<form action="Adherent_edit.php" method="post">
<div class="row">
  <fieldset>
    <legend>Modifier un Adherent</legend>
  <label for="nomAdherent"> Nom </label>
  <input id="nomAdherent" type="text" name="nomAdherent" value=<?php echo $nomAdherent;?>>
  <label for="adresse"> adresse </label>
  <input id="adresse" type="text" name="adresse" value=<?php echo $adresse;?>>
  <label for="datePaiement"> date de paiement</label>
  <input id="datePaiement" type="date" name="datePaiement" value=<?php echo $datePaiement; ?>>
  <input id="id" name="id" type="hidden" value=<?php echo $id; ?>>
  <input id="modifier" type="submit" name="modifier" value="modifier">
  </fieldset>
</div>
</form>
<?php
}
?>