<?php
	if (isset($_FILES["fileUpload"]) && $_FILES["fileUpload"]["error"] === UPLOAD_ERR_OK) {
        $uploadedFile = $_FILES["fileUpload"];

        // Retrieve file information
        $fileName = $uploadedFile["name"];
        $fileType = $uploadedFile["type"];
        $fileSize = $uploadedFile["size"];
        $fileTempPath = $uploadedFile["tmp_name"];

        // Move the uploaded file to a desired location
        $destinationPath = "files/" . $fileName;
        if (move_uploaded_file($fileTempPath, $destinationPath)) {
            // File uploaded successfully
            echo "File uploaded and moved to: " . $destinationPath;
			
			$hostname = 'localhost'; // Replace with your server hostname
			$username = 'root'; // Replace with your MySQL username
			$password = ''; // Replace with your MySQL password
			$database = 'forum';
	
			try {
				$connection = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
				$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// Connection established, you can now perform database operations
		
				$query = 'INSERT INTO publication (id_publication,titre,lien) VALUES (0,"'.$_POST["subject"].'","'.$destinationPath.'")';
				$connection->query($query);
			} catch (PDOException $e) {
				die('Failed to connect to MySQL: ' . $e->getMessage());
				header("location: login/index.php?connexion=erreur1");
			}
        } else {
            // Failed to move the uploaded file
            echo "Error moving the file to the destination directory.";
        }
	}

?>