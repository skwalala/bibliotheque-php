<?php
include('index.php');
include("connexion_bdd.php");
if(isset($_POST["noExemplaire"]) AND isset($_GET['idAdherent']) AND isset($_POST['dateEmprunt'])) {
	$donnees['idAdherent']=$_GET['idAdherent'];
	$idAdherent=$donnees['idAdherent'];
    $donnees['noExemplaire'] = $_POST['noExemplaire'];
    $noExemplaire=$donnees['noExemplaire'];
    $donnees['dateEmprunt'] = $_POST['dateEmprunt'];
    $dateEmprunt = $donnees['dateEmprunt'];

    $ma_requete_SQL="INSERT INTO EMPRUNT (idAdherent,noExemplaire,dateEmprunt) VALUES ('".$idAdherent."','".$noExemplaire."','".$dateEmprunt."');";
    print_r(($ma_requete_SQL));
    $bdd->exec($ma_requete_SQL);
    header("Location: Emprunt.show");
    echo "header";
}
if (isset($_GET['noExemplaire'])) {
$noExemplaire=$_GET['noExemplaire'];
}
?>

<form action="Emprunt_add2.php" method="post">
    <div class="row">
        <fieldset>
            <legend>Emprunter des livres</legend>
	            <label for="idAdherent"> Adherent :</label>
	            <?php 
	            $cat = $bdd->query("SELECT nomAdherent FROM ADHERENT WHERE idAdherent = '".$_GET["idAdherent"]."';");
	            $donnees = $cat->fetch();
	            echo $donnees['nomAdherent'];
	            ?>
	            <br>
	            <a href="Emprunt_add.php"> changer </a><br>
            	<label for="noExemplaire"> Exemplaire d'une Oeuvre :</label>
                <select name="noExemplaire" id="noExemplaire" >
                    <?php
                    $cat = $bdd->query("SELECT OEUVRE.noOeuvre,noExemplaire,titre FROM OEUVRE JOIN EXEMPLAIRE ON EXEMPLAIRE.noOeuvre ;");
                    $donnee = $cat->fetchAll();

                    foreach ($donnee as $categorie){
                        if (intval($noExemplaire) == intval($categorie['noExemplaire'])){
                            $string = "<option value='" . $categorie['noOeuvre'] . "' selected>" . $categorie['titre'];
                            $string = $string . "</option>";
                        }else {
                            $string = "<option value='" . $categorie['noOeuvre'] . "'>" . $categorie['titre'];
                            $string = $string . "</option>";
                        }
                        echo $string;
                    }?>
                </select><br>
                <label for="dateEmprunt">date Emprunt</label><br>
                <input type="date" name="dateEmprunt" value="<?php echo date('Y/m/d'); ?>">
                <input id="ajouter" type="submit" name="ajouter" value="ajouter">
       	</fieldset>
    </div>
 </form>