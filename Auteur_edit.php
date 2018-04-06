<?php
include('index.php');
if (!isset($_GET['auteur'])){
echo "go to index";
}else{
$idAuteur=$_GET['auteur'];
?>
<form action="." method="post">
  <fieldset>
	<label for="name"> nom :</label>
	<input id="name" type ="text" name="name">
	<label for="nickname"> prenom :</label>
	<input id="nickname" type="text" name="nickname">
	<input id="idAuteur" type="hidden" name="idAuteur" value=<?php echo $idAuteur; ?>>
	<input id="modifier" type="submit" name="modifier" value="modifier">
  </fieldset>
</form>
<?php
}
