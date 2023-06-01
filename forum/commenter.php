<?php
	if (isset($_POST["commentaire"])) {

        $hostname = 'localhost'; // Replace with your server hostname
		$username = 'root'; // Replace with your MySQL username
		$password = ''; // Replace with your MySQL password
		$database = 'forum';
	
		try {
			$connection = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// Connection established, you can now perform database operations
			$query = 'INSERT INTO commentaire (id_commentaire,id_publication,text) VALUES (0,"'.$_POST["id_publication"].'","'.$_POST["commentaire"].'")';
			$connection->query($query);
		} catch (PDOException $e) {
			die('Failed to connect to MySQL: ' . $e->getMessage());
			header("location: login/index.php?connexion=erreur1");
		}
	}

?>