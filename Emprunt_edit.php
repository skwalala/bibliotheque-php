<?php
include('index.php');

include("connexion_bdd.php");
if(isset($_POST['idAdherent']) AND isset($_POST['noExemplaire']) AND isset($_POST['dateEmprunt']) AND isset($_POST['dateRendu']))
{
        $donnees['idAdherent']=htmlentities($_POST['idAdherent']);
        $donnees['noExemplaire']=htmlentities($_POST['noExemplaire']);
        $donnees['dateEmprunt']=htmlentities($_POST['dateEmprunt']);
        $donnees['dateRendu']=htmlentities($_POST['dateRendu']);

        $ma_requete_SQL="UPDATE EMPRUNT SET idAdherent='".$donnees['idAdherent']."', noExemplaire='".$donnees['noExemplaire']."', dateEmprunt='".$donnees['dateEmprunt']."',dateRendu='".$donnees['dateRendu']."' WHERE idAdherent='".$_POST['idAdherent']."';";
        print_r($ma_requete_SQL);
        $bdd->exec($ma_requete_SQL);
        header("Location: Emprunt_show.php");
}




if (!isset($_GET['idAdherent']) OR !isset($_GET['noExemplaire']) OR !isset($_GET['dateEmprunt']) AND !isset($_POST['dateRendu'])){
}else{
$idAdherent=$_GET['idAdherent'];
$noExemplaire=$_GET['noExemplaire'];
$dateEmprunt=$_GET['dateEmprunt'];
$dateRendu=$_GET['dateRendu'];
?>
<form action="Emprunt_edit.php" method="post">
<div class="row">
  <fieldset>
    <legend>Modifier un Emprunt</legend>
  <label for="idAdherent"> Adherent (id) </label>
  <input id="idAdherent" type="text" name="idAdherent" value=<?php echo $idAdherent;?>>
  <label for="noExemplaire"> Exemplaire (no) </label>
  <input id="noExemplaire" type="text" name="noExemplaire" value=<?php echo $noExemplaire;?>>
  <label for="dateEmprunt"> date Emprunt</label>
  <input id="dateEmprunt" type="date" name="dateEmprunt" value=<?php echo $dateEmprunt; ?>>
  <label for="dateRendu"> date Rendu</label>
  <input id="dateRendu" name="dateRendu" type="date" value=<?php echo $dateRendu; ?>>
  <input id="modifier" type="submit" name="modifier" value="modifier">
  </fieldset>
</div>
</form>
<?php
}
?>