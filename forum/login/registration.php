<?php
	if(!isset($_POST['id'])) header('Location: index.php');
	if($_POST['pwd']!=$_POST['pwd1']) header('Location: index.php?pwd=erreur');
	
	
?>