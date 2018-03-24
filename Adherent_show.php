<?php
include("connexion_bdd.php");
$ma_requete_SQL = "SELECT ADHERENT.idADHERENT, ADHERENT.nomAdherent, 
ADHERENT.adresse, ADHERENT.datePaiement
FROM ADHERENT
ORDER BY ADHERENT.idADHERENT;";
$reponse = $bdd->query($ma_requete_SQL);
$donnees = $reponse->fetchAll();

echo"<pre>"; print_r($donnees); echo"</pre>";
?>