<?php
include('index.php');
include("connexion_bdd.php");
if(isset($_POST["noOeuvre"]) AND isset($_POST["etat"]) AND isset($_POST["dateAchat"]) AND isset($_POST["prix"]))
{
	$donnees['noOeuvre']=$_POST["noOeuvre"];
	$donnees['etat']=$_POST["etat"];
	$donnees['dateAchat']=htmlentities($_POST['dateAchat']);
	$donnees['prix']=htmlentities($_POST['prix']);

	$ma_requete_SQL="INSERT INTO EXEMPLAIRE (noExemplaire, etat, dateAchat, prix, noOeuvre) VALUES (NULL,'".$donnees['etat']."','".$donnees['dateAchat']."','".$donnees['prix']."','".$donnees['noOeuvre']."');";
	print_r($ma_requete_SQL);
	$bdd->exec($ma_requete_SQL);
	$noOeuvre=$donnees['noOeuvre'];
	header("Location: Exemplaire_show.php?idOeuvre=$noOeuvre");
	echo "header";
}

if(isset($_GET['noOeuvre'])){
    $noOeuvre=$_GET['noOeuvre'];
}

?>

<form action="Exemplaire_add.php" method="post">
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
            <input id="etat" type="text" name="etat">
            <label for="dateAchat"> date de l'Achat :</label>
            <input id="dateAchat" type="date" name="dateAchat">
            <label for="prix"> prix :</label>
            <input id="prix" name="prix">
            <input id="modifier" type="submit" name="modifier" value="ajouter">
        </fieldset>
    </div>
</form>