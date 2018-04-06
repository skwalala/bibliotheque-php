<?php
include("connexion_bdd.php");

$r_oeuvre="SELECT titre, noOeuvre, idAuteur,dateParution
from OEUVRE
ORDER BY titre;";
$oeuvres = $bdd->query($r_oeuvre);
$data = $oeuvres->fetchAll();

