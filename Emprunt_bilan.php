<?php
// connexion à la base de données : 
// création d'une instance d'un objet PDO de nom $bdd
include("connexion_bdd.php");
include("index.php");
// traitement :
// test si on soumet un formulaire ou pas
// test si il y a des paramètres dans L’URL
// en fonction des tests, exécution de requête(s) SQL
// en fonction des tests et des résultats des requêtes SQL, création de variables, tableaux associatifs ...
// éventuellement redirection

// affichage de la vue
  $requete ="SELECT ADHERENT.idAdherent, ADHERENT.nomAdherent, OEUVRE.titre, EMPRUNT.dateEmprunt, EXEMPLAIRE.noExemplaire, EMPRUNT.dateRendu
             FROM ADHERENT
             JOIN EMPRUNT ON EMPRUNT.idAdherent = ADHERENT.idAdherent
             JOIN EXEMPLAIRE ON EXEMPLAIRE.noExemplaire = EMPRUNT.noExemplaire
             JOIN OEUVRE ON EXEMPLAIRE.noOeuvre = OEUVRE.noOeuvre
             ";
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
                  <td class="text-center" >Nom adherent</th>
                  <td class="text-center" >Titre</th>
                  <td class="text-center" >Date d'emprunt</th>
                  <td class="text-center" >Pénalité</th>
                  <td class="text-center" >Exemplaire</th>
              </tr>
              <?php foreach ($donnees as $row ): 
              if (isset($row['dateRendu']) and $row['dateRendu'] != '0000-00-00' ){
              }else{?>
                <tr>
                  <td class="text-center" ><?php echo $row['nomAdherent']; ?></td>
                  <td class="text-center" ><?php echo $row['titre']; ?></td>
                  <td class="text-center" ><?= date('d/m/Y',strtotime($row['dateEmprunt'])) ?></td>
                    <?php
                      if (date('Y-m-d') > date('Y-m-d',strtotime('+2 months',strtotime($row['dateEmprunt'])))){
                        echo '<td class="text-center">';
                        $jour = new DateTime(date('Y-m-d'));
                        $date_limite = new DateTime(date('Y-m-d',strtotime('+2 months',strtotime($row['dateEmprunt']))));
                        $retard = $date_limite->diff($jour);
                        $retard = $retard->format('%a');
                        echo $retard;
                        } else {
                          echo '<td class="text-center">';
                      }
                      ?>
                  </td>
                  <td class="text-center" >n°<?= $row['noExemplaire'] ?></td>
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
