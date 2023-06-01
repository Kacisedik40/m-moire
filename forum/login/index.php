<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Responsive Login and Signup Form </title>

        <!-- CSS -->
        <link rel="stylesheet" href="css/style.css">
                
        <!-- Boxicons CSS -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
                        
    </head>
    <body>
        <section class="container forms">
            <div class="form login">
                <div class="form-content">
                    <header>Connexion</header>
                    <form action="../index.php" method='POST'>
                        <div class="field input-field">
                            <input type="email" name='email' placeholder="Email" class="input">
                        </div>

                        <div class="field input-field">
                            <input type="password" name='pwd' placeholder="Mot de passe" class="password">
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="field button-field">
                            <button name="login">Connexion</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Vous n'avez pas de compte ? <a href="#" class="link signup-link">Registration</a></span>
                    </div>
                </div>
            </div>

            <!-- Signup Form -->

            <div class="form signup">
                <div class="form-content">
                    <header>Registration</header>
                    <form action="../index.php" method="POST">
                        <div class="field input-field">
                            <input name="id" type="text" placeholder="Identifiant" class="input">
                        </div>
                        <div class="field input-field">
                            <input name="nom_prenom" type="text" placeholder="Nom et Prenom" class="input">
                        </div>
                        <div class="field input-field">
                            <input name="date_naissance" type="text" placeholder="Date de naissance (2000-05-21)" class="input">
                        </div>
                        <div class="field input-field">
                            <input name="email" id="email" type="email" placeholder="Email" class="input">
                        </div>

                        <div class="field input-field">
                            <input name="pwd" type="password" placeholder="Mot de passe" class="password">
                        </div>

                        <div class="field input-field">
                            <input name="pwd1" type="password" placeholder="Confirmer mot de passe" class="password">
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="field button-field">
                            <button name="register">Registration</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Vous avez déjà un compte? <a href="#" class="link login-link">Connexion</a></span>
                    </div>
                </div>

            </div>
        </section>

        <!-- JavaScript -->
        <script src="js/script.js"></script>
		<script src="js/jquery.js"></script>
		<script>
			$('#email').blur(
				function(){
					var userinput = $(this).val();
					var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
					if(!pattern.test(userinput)){
						alert('Erreur');
						$(this).css('color','red');
					}else{
						$(this).css('color','black');
					}
				}
			);
		</script>
    </body>
</html>