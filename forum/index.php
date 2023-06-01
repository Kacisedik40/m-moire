<!DOCTYPE html>
<?php
	if(!isset($_POST['id'])){
		if(!isset($_COOKIE["id_user"])) if(!isset($_POST["email"])) header("location: login/index.php");
	}else{
		if($_POST['pwd']!=$_POST['pwd1']) header("location: login/index.php?pwd=erreur1");
	}
	
	$hostname = 'localhost'; // Replace with your server hostname
	$username = 'root'; // Replace with your MySQL username
	$password = ''; // Replace with your MySQL password
	$database = 'forum';
	
	try {
		$connection = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// Connection established, you can now perform database operations
		
		if(isset($_POST['id'])){
			$query = 'INSERT INTO etudiant (id,nom_prenom,date_naissance,email,pwd,active) VALUES ("'.$_POST["id"].'","'.$_POST["nom_prenom"].'","'.$_POST["date_naissance"].'","'.$_POST["email"].'","'.$_POST["pwd"].'",1)';
			$connection->query($query);
			
			$cookieName = 'id_user';
			$cookieValue = $_POST["id"];
			$expiration = time() + (3600*5); // Current time + 1 hour
			$path = '/';
			$domain = '';
			
			setcookie($cookieName, $cookieValue, $expiration, $path, $domain);
			
			$query_user = 'SELECT * FROM etudiant where id="'.$_COOKIE["id_user"].'"';
			$result_user = $connection->query($query_user);
		
			if (!($row_user = $result_user->fetch(PDO::FETCH_ASSOC))) header("location: login/index.php?fetch=erreur1");
			header("location: index.php");
		}else if(isset($_POST['email'])){
			$query_user = 'SELECT * FROM etudiant where email="'.$_POST["email"].'"';
			$result_user = $connection->query($query_user);
		
			if (!($row_user = $result_user->fetch(PDO::FETCH_ASSOC))) header("location: login/index.php?fetch=erreur2");
			
			$cookieName = 'id_user';
			$cookieValue = $row_user["id"];
			$expiration = time() + (3600*5); // Current time + 1 hour
			$path = '/';
			$domain = '';
			
			setcookie($cookieName, $cookieValue, $expiration, $path, $domain);
			header("location: index.php");
		}else{
			$query_user = 'SELECT * FROM etudiant where id="'.$_COOKIE["id_user"].'"';
			$result_user = $connection->query($query_user);
		
			if (!($row_user = $result_user->fetch(PDO::FETCH_ASSOC))) header("location: login/index.php?fetch=erreur3_".$_COOKIE['id_user']);
		}
		
		
	} catch (PDOException $e) {
		die('Failed to connect to MySQL: ' . $e->getMessage());
		header("location: login/index.php?connexion=erreur1");
	}
?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Forum</title>
    <meta name="description" content="" />
    <meta name="author" content="Tooplate" />
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Additional CSS Files -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/fontawesome.css" />
    <link rel="stylesheet" href="assets/css/tooplate-style.css" />
    <link rel="stylesheet" href="assets/css/owl.css" />
    <link rel="stylesheet" href="assets/css/lightbox.css" />
	<style>
		#pub input {
			background-color: rgba(250,250,250,0.1);
    		border: 1px solid rgba(250,250,250,1);
    		border-radius: 0px;
    		margin-bottom: 30px;
    		color: #fff;
    		font-size: 14px;
    		height: 40px;
    		width: 100%;
    		padding-left: 15px;
		}

		#pub input:focus {
    		outline: none;
    		box-shadow: none;
			color: #fff;
		}

		#pub {
    		text-align: center;
		}
		
		#pub button {
			height: 40px;
		}
		
		#commenter button {
			height: 40px;
		}
		
		#commenter input {
			background-color: rgba(250,250,250,0.1);
    		border: 1px solid rgba(250,250,250,1);
    		border-radius: 0px;
    		margin-bottom: 30px;
    		color: #fff;
    		font-size: 14px;
    		height: 40px;
    		width: 100%;
    		padding-left: 15px;
		}
		
		#commenter textarea {
			background-color: rgba(250,250,250,0.1);
    		border: 1px solid rgba(250,250,250,1);
    		border-radius: 0px;
    		margin-bottom: 30px;
    		color: #fff;
    		font-size: 14px;
    		width: 100%;
    		padding-left: 15px;
		}

		#commenter input:focus {
    		outline: none;
    		box-shadow: none;
			color: #fff;
		}

		#commenter textarea:focus {
    		outline: none;
    		box-shadow: none;
			color: #fff;
		}

		#commenter {
    		text-align: center;
		}
		
		.section-heading {
			text-align: left;
			padding: 10px 0 10px 0;
		}
		.service-item {
			margin-bottom: 5px;
			padding: 10px;
			background-color: rgba(250, 250, 250, 0.1);
			transition: all 0.5s;
		}
		.service-item .fa {
			font-size: 72px;
			padding: 0px 0;
			transition: all 0.5s;
		}
		#para {
			margin: 0px;
		}
	</style>
	
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/custom.js"></script>
	
  </head>
<!--
Tooplate 2116 Blugoon
https://www.tooplate.com/view/2116-blugoon
-->
  <body>
    <div id="page-wraper">
      <!-- Sidebar Menu -->
      <div class="responsive-nav">
        <i class="fa fa-bars" id="menu-toggle"></i>
        <div id="menu" class="menu">
          <i class="fa fa-times" id="menu-close"></i>
          <div class="container">
            <div class="image">
              <i class="fa fa-user" style="font-size:100px;color:lightblue;text-shadow:2px 2px 4px #000000;"></i>
            </div>
            <div class="author-content">
              <h4><?php echo "Bienvenue" ?></h4>
              <span><?php echo $row_user["nom_prenom"]; ?></span>
            </div>
            <nav class="main-nav" role="navigation">
              <ul class="main-menu">
                <li class='active'><a style="cursor:pointer;">Accueil</a></li>
                <li><a href="deconnecter.php" style="cursor:pointer;">Déconnexion</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>

      <section class="section about-me" data-section="section1">
        <div class="container">
        <div class="top-header">
        	<img src="image/couverture.jpg" alt="Bienvenue"  />
        </div>
          <div class="section-heading">
			<form id="pub" action="" method="post">
            <div class="col-md-12">
				<fieldset>
					<input name="subject" type="text" class="form-control" id="subject" placeholder="Titre...!" required="" />
                </fieldset>
			</div>
			<div class="col-md-3">
				<fieldset>
					<input type="file" name="fileUpload" class="button">
                </fieldset>
			</div>
			
			<div class="col-md-3">
				<fieldset>
                    <button type="submit" id="form-submit" class="button_envoyer">Envoyer</button>
				</fieldset>
            </div>
			
			</form>
            <div class="line-dec"></div>
          </div>
		  <?php
			$query_pub = 'SELECT * FROM publication';
			$result_pub = $connection->query($query_pub);
			$indice=1;
			while ($row_pub = $result_pub->fetch(PDO::FETCH_ASSOC)){
		  ?>
          <div class="right-image-post">
            <div class="section-heading">
 
              <div class="col-md-12">
                <div class="left-text">
                  <h4><?php echo $row_pub['titre']; ?></h4>
                  <p><a href="<?php echo $row_pub['lien']; ?>">Télécharger<i class="fa fa-file" style="font-size:40px;color:lightblue;text-shadow:2px 2px 4px #000000;"></i></a></p>
                </div>
              </div>
			  
				<form class="commenter<?php echo $indice; ?>" id="commenter" action="" method="post">
					<div class="col-md-20">
						<fieldset>
							<textarea name="commentaire" class="form-control" placeholder="Titre...!" required="" rows="1"></textarea>
						</fieldset>
					</div>
			
					<div class="col-md-3">
						<fieldset>
							<button type="submit" id="form-submit" class="button_envoyer">Commenter</button>
						</fieldset>
					</div>
					<input type="hidden" name="id_publication" value="<?php echo $row_pub['id_publication']; ?>">
				</form>
              
            </div>
			<div class="row">
			<?php
			$query_commentaire = 'SELECT * FROM commentaire where id_publication='.$row_pub['id_publication'];
			$result_commentaire = $connection->query($query_commentaire);
			while ($row_commentaire = $result_commentaire->fetch(PDO::FETCH_ASSOC)){
			?>
            <div class="col-md-12">
              <div class="service-item">
                <i class="fa fa-comments"></i>
                <!--<h4>Top Performance</h4>-->
                <p id="para"><?php echo $row_commentaire["text"]; ?></p>
              </div>
            </div>
			<?php
			}
			?>
			</div>
          </div>
		  <script>
		  $('.commenter<?php echo $indice; ?>').submit(function(e){
				e.preventDefault();
				
				var formData=new FormData(this);
				$.ajax({
					url:"commenter.php",
					type:"POST",
					data:formData,
					processData:false,
					contentType:false,
					success: function(response) {
						// Handle success response
						alert(response);
						location.reload();
					},
					error: function(xhr, status, error) {
						// Handle error response
						console.log(error);
						alert("An error occurred while uploading the file.");
					}
				});
			});
		  </script>
		  <?php
			$indice++;
			}
		  ?>
        </div>
      </section>
	  
	  <!--
      <section class="section my-services" data-section="section2">
        <div class="container">
          <div class="section-heading">
            <h2>Greatest Features</h2>
            <div class="line-dec"></div>
            <span>Praesent posuere fringilla elit, non maximus tellus posuere nec. Nunc eu sapien nec est elementum sodales.</span>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="service-item">
                <i class="fa fa-area-chart"></i>
                <h4>Top Performance</h4>
                <p>Donec sit amet tempor quam. Maecenas nec aliquam leo, sed tincidunt urna.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="service-item">
                <i class="fa fa-check-square-o"></i>
                <h4>Trusted Service</h4>
                <p>Etiam at porta nulla, et euismod enim. Nullam semper ipsum et dui scelerisque.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="service-item">
                <i class="fa fa-question-circle"></i>
                <h4>Need Help?</h4>
                <p>Phasellus orci leo, elementum ac risus id, euismod porta lorem. Quisque feugiat.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="service-item">
                <i class="fa fa-support"></i>
                <h4>Quick Support</h4>
                <p>Mauris eu est vitae erat condimentum pellentesque. Fusce vehicula nunc.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section my-work" data-section="section3">
        <div class="container">
          <div class="section-heading">
            <h2>Gallery</h2>
            <div class="line-dec"></div>
            <span>Donec sit amet enim tempor nisl fermentum aliquam. In consectetur sapien eu nisi venenatis lobortis. Sed ullamcorper tristique elit nec facilisis.</span>
          </div>
          <div class="row">
            <div class="isotope-wrapper">
              <form class="isotope-toolbar">
                <label><input type="radio" data-type="*" checked="" name="isotope-filter" />
                  <span>all</span></label>
                <label><input type="radio" data-type="pretty" name="isotope-filter" />
                  <span>pretty</span></label>
                <label><input type="radio" data-type="sexy" name="isotope-filter" />
                  <span>sexy</span></label>
                <label><input type="radio" data-type="beach" name="isotope-filter" />
                  <span>beach</span></label
                >
              </form>
              <div class="isotope-box">
                <div class="isotope-item" data-type="beach">
                  <figure class="snip1321">
                    <img src="assets/images/woman-beach.jpg" alt="woman at the beach" />
                    <figcaption>
                      <a href="assets/images/woman-beach.jpg"
                        data-lightbox="image-1"
                        data-title="Caption"><i class="fa fa-search"></i></a>
                      <h4>Girl One</h4>
                      <span>woman at the beach</span>
                    </figcaption>
                  </figure>
                </div>

                <div class="isotope-item" data-type="sexy">
                  <figure class="snip1321">
                    <img src="assets/images/woman-chair-sunshine.jpg" alt="sq-sample26" />
                    <figcaption>
                      <a href="assets/images/woman-chair-sunshine.jpg"
                        data-lightbox="image-1"
                        data-title="Sunshine Woman"><i class="fa fa-search"></i></a>
                      <h4>Sexy Lady</h4>
                      <span>there you go sexy girl</span>
                    </figcaption>
                  </figure>
                </div>

                <div class="isotope-item" data-type="pretty">
                  <figure class="snip1321">
                    <img src="assets/images/woman-pretty.jpg" alt="Pretty Girl" />
                    <figcaption>
                      <a href="assets/images/woman-pretty.jpg"
                        data-lightbox="image-1"
                        data-title="Pretty Girl"><i class="fa fa-search"></i></a>
                      <h4>Pretty Girl</h4>
                      <span>red flowers white girl</span>
                    </figcaption>
                  </figure>
                </div>

                <div class="isotope-item" data-type="pretty">
                  <figure class="snip1321">
                    <img src="assets/images/escalator-blue.jpg" alt="Escalator Blue" />
                    <figcaption>
                      <a href="assets/images/escalator-blue.jpg"
                        data-lightbox="image-1"
                        data-title="Escalator Blue"><i class="fa fa-search"></i></a>
                      <h4>Escalator Up</h4>
                      <span>Blue architecture building</span>
                    </figcaption>
                  </figure>
                </div>

                <div class="isotope-item" data-type="beach">
                  <figure class="snip1321">
                    <img src="assets/images/woman-feeling.jpg" alt="woman feeling" />
                    <figcaption>
                      <a href="assets/images/woman-feeling.jpg"
                        data-lightbox="image-1"
                        data-title="Her Feeling"><i class="fa fa-search"></i></a>
                      <h4>Her Feeling</h4>
                      <span>Ut sollicitudin risus</span>
                    </figcaption>
                  </figure>
                </div>

                <div class="isotope-item" data-type="sexy">
                  <figure class="snip1321">
                    <img src="assets/images/woman-bikini.jpg" alt="Bikini Girl" />
                    <figcaption>
                      <a href="assets/images/woman-bikini.jpg" 
                      data-lightbox="image-1" data-title="Sexy Bikini">
                      <i class="fa fa-search"></i></a>
                      <h4>Bikini Girl</h4>
                      <span>Donec eget massa ante</span>
                    </figcaption>
                  </figure>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section contact-me" data-section="section4">
        <div class="container">
          <div class="section-heading">
            <h2>Contact</h2>
            <div class="line-dec"></div>
            <span>Aenean a consectetur mi, sit amet consequat velit. Mauris vitae nunc viverra, mattis arcu quis, vestibulum eros. </span>
          </div>
          <div class="row">
            <div class="right-content">
              <div class="container">
                <form id="contact" action="" method="post">
                  <div class="row">
                    <div class="col-md-6">
                      <fieldset>
                        <input name="name" type="text" class="form-control"
                          id="name" placeholder="Your name..." required="" />
                      </fieldset>
                    </div>
                    <div class="col-md-6">
                      <fieldset>
                        <input name="email" type="text" class="form-control"
                          id="email" placeholder="Your email..." required=""  />
                      </fieldset>
                    </div>
                    <div class="col-md-12">
                      <fieldset>
                        <input name="subject" type="text" class="form-control" 
                          id="subject" placeholder="Subject..." required="" />
                      </fieldset>
                    </div>
                    <div class="col-md-12">
                      <fieldset>
                        <textarea name="message" rows="6" class="form-control"
                          id="message" placeholder="Your message..." required="" ></textarea>
                      </fieldset>
                    </div>
                    <div class="col-md-12">
                      <fieldset>
                        <button type="submit" id="form-submit" class="button">
                          Send Message
                        </button>
                      </fieldset>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>-->
    </div>
    <!-- Scripts -->
    <script>
		$(document).ready(function(){
			$('#pub').submit(function(e){
				e.preventDefault();
				
				var formData=new FormData(this);
				$.ajax({
					url:"publier.php",
					type:"POST",
					data:formData,
					processData:false,
					contentType:false,
					success: function(response) {
						// Handle success response
						alert(response);
						location.reload();
					},
					error: function(xhr, status, error) {
						// Handle error response
						console.log(error);
						alert("An error occurred while uploading the file.");
					}
				});
			});
		});
		
      //according to loftblog tut
      /*$(".main-menu li:first").addClass("active");

      var showSection = function showSection(section, isAnimate) {
        var direction = section.replace(/#/, ""),
          reqSection = $(".section").filter(
            '[data-section="' + direction + '"]'
          ),
          reqSectionPos = reqSection.offset().top - 0;

        if (isAnimate) {
          $("body, html").animate(
            {
              scrollTop: reqSectionPos
            },
            800
          );
        } else {
          $("body, html").scrollTop(reqSectionPos);
        }
      };

      var checkSection = function checkSection() {
        $(".section").each(function() {
          var $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
          if (topEdge < wScroll && bottomEdge > wScroll) {
            var currentId = $this.data("section"),
              reqLink = $("a").filter("[href*=\\#" + currentId + "]");
            reqLink
              .closest("li")
              .addClass("active")
              .siblings()
              .removeClass("active");
          }
        });
      };

      $(".main-menu").on("click", "a", function(e) {
        e.preventDefault();
        showSection($(this).attr("href"), true);
      });

      $(window).scroll(function() {
        checkSection();
      });*/
    </script>
  </body>
</html>