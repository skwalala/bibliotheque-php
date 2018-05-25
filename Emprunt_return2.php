<?php
include('index.php');
include("connexion_bdd.php");

error_reporting(E_ALL);
ini_set('display_errors', '1');?>

    <div class="row">
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
            <?php if (isset($donnees[0]))   : ?>
              <tr>
                  <td class="text-center" >Titre</th>
                  <td class="text-center" >Date d'emprunt</th>
                  <td class="text-center" >nb Jours</th>
                  <td class="text-center" >Exemplaire</th>
                  <td class="text-center" >Rendre</th>
              </tr>
              <?php
                foreach ($donnees as $row ):
              if ($row['dateRendu'] == "" or $row['dateRendu'] == "0000-00-00") {
              ?>
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
                            <td>  <a href="Emprunt_return3.php?idAdherent=<?=$_GET["idAdherent"]?>&noExemplaire=<?=$row['noExemplaire']?>">rendre</a></td>

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
    </div>