<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Liste de Courses</title>

	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="css/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/popper.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/jquery-ui.min.js" type="text/javascript"></script>

	<script src="js/perso.js" type="text/javascript"></script>
	<link href="css/style.css" rel="stylesheet" type="text/css"/>

</head>

<body>

	<header>
		<div class="titre">
			<h2>Liste de courses</h2>
		</div>
	</header>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Features</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Pricing</a>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#">Disabled</a>
				</li>
			</ul>
		</div>
	</nav>

	<main class="container">
		<div class="row">
			<div class="col-8" >
				<?php
				$bdd = new PDO('mysql:host=localhost;dbname=liste_courses;charset=utf8', 'root', '');
				
				$requete = "SELECT * FROM courses";

					if ($req_courses = $bdd->query($requete)) {
						$les_courses = $req_courses->fetchAll();
							//var_dump($les_courses);

					echo '<table class="table">';
					echo '<thead>';
					echo '<tr>';
					echo '<th>Nom du produit</th>';
					echo '<th >Quantité</th>';
					
					echo '<th>Fait</th>';
					echo '<th>Supprimer</th>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					
				}
				?>

			</div>
			
		</div>
	</main>


	<footer class="footer" id="fin">
	</footer>

</body>
</html>

