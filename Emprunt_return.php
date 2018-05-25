<?php
include('index.php');
include("connexion_bdd.php");
if(isset($_POST['idAdherent']))
{
	$donnees['idAdherent']=$_POST['idAdherent'];
	$idAdherent=$donnees['idAdherent'];
	header("Location: Emprunt_return2.php?idAdherent=$idAdherent");
	echo "header";
}
?>
<form action="Emprunt_return.php" method="post">
    <div class="row">
        <fieldset>
            <legend>Rendre des livres</legend>
            <label for="idAdherent"> Adherent :</label><br>
            <select name="idAdherent" id="idAdherent" >
                <?php
                $cat = $bdd->query("SELECT idAdherent,nomAdherent FROM ADHERENT;");
                $donnees = $cat->fetchAll();

                foreach ($donnees as $categorie){
                    if (intval($idAdherent) == intval($categorie['idAdherent'])){
                        $string = "<option value='" . $categorie['idAdherent'] . "' selected>" . $categorie['nomAdherent'];
                        $string = $string . "</option>";
                    }else {
                        $string = "<option value='" . $categorie['idAdherent'] . "'>" . $categorie['nomAdherent'];
                        $string = $string . "</option>";
                    }
                    echo $string;
                }?>
            </select><br>
            <input id="valider" type="submit" name="valider" value="valider">