<?php
include('index.php');

include("connexion_bdd.php");
if(isset($_POST["noExemplaire"]) AND isset($_POST["noOeuvre"]) AND isset($_POST["etat"]) AND isset($_POST["dateAchat"]) AND isset($_POST['prix']))
{
        $donnees['noExemplaire']=htmlentities($_POST["noExemplaire"]);
        $donnees['noOeuvre']=htmlentities($_POST['noOeuvre']);
        $donnees['etat']=htmlentities($_POST['etat']);
        $donnees['dateAchat']=htmlentities($_POST['dateAchat']);
        $donnees['prix']=htmlentities($_POST['prix']);

        $ma_requete_SQL="UPDATE EXEMPLAIRE SET prix='" .$donnees['prix']."',
         noOeuvre='".$donnees['noOeuvre']."',
          etat='".$donnees['etat']."',
           dateAchat='".$donnees['dateAchat']."' 
           WHERE noExemplaire=".$_POST['noExemplaire'].";";

        print_r($ma_requete_SQL);
        $bdd->exec($ma_requete_SQL);

}


if (!(isset($_GET['noExemplaire']) AND isset($_GET['noOeuvre']) AND isset($_GET['etat']) AND isset($_GET['dateAchat']) AND isset($_GET['prix']))){
    if (isset($donnees['noOeuvre'])) {
        header("Location: Exemplaire_show.php?idOeuvre=" . $donnees['noOeuvre']);
    }else if (isset($_GET['noOeuvre'])){
        header("Location: Exemplaire_show.php?idOeuvre=".$_GET['noOeuvre']);
    }else{
        header("Location: Exemplaire_show.php");
    }
}else{
    $noExemplaire=$_GET['noExemplaire'];
    $noOeuvre=$_GET['noOeuvre'];
    $etat=$_GET['etat'];
    $dateAchat=$_GET['dateAchat'];
    $prix=$_GET['prix'];
    ?>
    <form action="Exemplaire_edit.php" method="post">
    <div class="row">
      <fieldset>
        <legend>editer un Exemplaire</legend>
        <label for="noOeuvre"> Oeuvre :</label><br>
          <select name="noOeuvre" id="noOeuvre" >
              <?php
              $cat = $bdd->query("SELECT noOeuvre,titre FROM OEUVRE;");
              $donnee = $cat->fetchAll();

              foreach ($donnee as $categorie){
                  if (intval($noOeuvre) == intval($categorie['noOeuvre'])){
                      $string = "<option value='" . $categorie['noOeuvre'] . "' selected>" . $categorie['titre'];
                      $string = $string . "</option>";
                  }else {
                      $string = "<option value='" . $categorie['noOeuvre'] . "'>" . $categorie['titre'];
                      $string = $string . "</option>";
                  }
                  echo $string;
              }?>
          </select><br>
        <label for="etat"> etat :</label>
        <input id="etat" type="text" name="etat" value=<?php echo $etat;?>>
        <label for="dateAchat"> date de l'Achat :</label>
        <input id="dateAchat" type="date" name="dateAchat" value=<?php echo $dateAchat; ?>>
        <label for="prix"> prix :</label>
        <input id="prix" name="prix" value=<?php echo $prix; ?>>
        <input id="noExemplaire" name="noExemplaire" type="hidden" value=<?php echo $noExemplaire; ?>>
        <input id="modifier" type="submit" name="modifier" value="modifier">
      </fieldset>
    </div>
    </form>
<?php
}
