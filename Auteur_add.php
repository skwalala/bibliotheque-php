<?php
include('index.php');
?>
<form action="." method="post">
  <fieldset>
	<label for="name"> nom :</label>
	<input id="name" type ="text" name="name">
	<label for="nickname"> prenom :</label>
	<input id="nickname" type="text" name="nickname">
	<input id="ajouter" type="submit" name="ajouter" value="ajouter">
  </fieldset>
</form>
