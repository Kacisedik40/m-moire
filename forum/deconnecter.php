<?php
	setcookie('id_user', '', time() - 3600, '/');
	header("location: login/");
?>