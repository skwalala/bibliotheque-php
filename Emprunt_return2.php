<?php
include('index.php');
include("connexion_bdd.php");
if(isset($_POST['dateRendu'])){
	$donnees['dateRendu'] = $_POST['dateRendu'];

	$ma_requete_SQL="UPDATE EMPRUNT SET dateRendu = '".$donnees['dateRendu']."' WHERE idAdherent = '".$_GET["idAdherent"]."';";
		print_r(($ma_requete_SQL));
    	$bdd->exec($ma_requete_SQL);
    	header("Location: Emprunt_return.php");
    	echo "header";
}
?>
<form action="Emprunt_return2.php" method="post">
    <div class="row">
        <fieldset>
            <legend>Rendre des livres</legend>
	            <label for="idAdherent"> Adherent :</label>
	            <?php 
	            $cat = $bdd->query("SELECT nomAdherent FROM ADHERENT WHERE idAdherent = '".$_GET["idAdherent"]."';");
	            $donnees = $cat->fetch();
	            echo $donnees['nomAdherent'];
	            ?>
	            <br>
	            <a href="Emprunt_return.php"> changer </a><br>
	            <?php
            $requete ="SELECT ADHERENT.idAdherent, ADHERENT.nomAdherent, OEUVRE.titre, EMPRUNT.dateEmprunt, EXEMPLAIRE.noExemplaire, EMPRUNT.dateRendu
             FROM ADHERENT
             JOIN EMPRUNT ON EMPRUNT.idAdherent = ADHERENT.idAdherent
             JOIN EXEMPLAIRE ON EXEMPLAIRE.noExemplaire = EMPRUNT.noExemplaire
             JOIN OEUVRE ON EXEMPLAIRE.noOeuvre = OEUVRE.noOeuvre
             WHERE ADHERENT.idAdherent = '".$_GET["idAdherent"]."';";
  			$reponse = $bdd->query($requete);
  			$donnees = $reponse->fetchAll(); ?>
  			<div class="container" style="margin-top: 100px;">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
        Recapitulatif des Emprunts
        </div>
        <div class="card-body">
          <table class="table" border="2">
            <?php if ($donnees[0]): ?>
              <tr>
                  <td class="text-center" >Titre</th>
                  <td class="text-center" >Date d'emprunt</th>
                  <td class="text-center" >nb Jours</th>
                  <td class="text-center" >Exemplaire</th>
                  <td class="text-center" >Date rendu</th>
                  <td class="text-center" >Rendre</th>
              </tr>
              <?php foreach ($donnees as $row ): 
              if ($row['dateRendu'] == null) {
              }else{?>
                <tr>
                  <td class="text-center" ><?php echo $row['titre']; ?></td>
                  <td class="text-center" ><?= date('d/m/Y',strtotime($row['dateEmprunt'])) ?></td>
                  <?php 
        	          echo '<td class="text-center">';
            	      $jour = new DateTime(date('Y-m-d'));
                	  $date_limite = new DateTime(date('Y-m-d',strtotime('+2 months',strtotime($row['dateEmprunt']))));
                 	 $retard = $date_limite->diff($jour);
                 	 $retard = $retard->format('%a');
                  	echo $retard;
                  ?>
                  </td>
                  <td class="text-center" >n°<?= $row['noExemplaire'] ?></td>
                  <td><input type="date" name="dateRendu" value="<?php echo date('Y/m/d'); ?>"></td>
                  <td>  <input id="rendre" type="submit" name="rendre" value="rendre"></td>
                </tr>
              <?php } 
              endforeach; ?>
            <?php else: ?>
              <tr>
                <td>Pas d'enregistrements</td>
              </tr>
          <?php endif; ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>