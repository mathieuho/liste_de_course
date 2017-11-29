<?php
$bdd = new PDO('mysql:host=localhost;dbname=liste_courses;charset=utf8', 'root', '');

// Modifier une ligne via le formualire

if (isset($_POST['id_modif_post'])) {
	$id_courses = intval($_POST['id_modif_post']);
	$nom      = (isset($_POST['nom'])) ? $bdd->quote($_POST['nom']) : "";
	$quantite = (isset($_POST['quantite'])) ? intval($_POST['quantite']) : 1;

	$requete_update = "UPDATE courses SET nom = $nom, quantite=$quantite WHERE id_courses = $id_courses";
	if(!$bdd->query($requete_update)) { // On execute la requete
		echo($bdd->errorInfo()[2]); // si erreur, on affiche l'erreur
	}

} 

// enregistrement du formulaire : création
if (isset($_POST['nom'])) {
	$nom = $bdd->quote($_POST['nom']);
	$quantite = 1;
	if (isset($_POST['quantite'])) {
		$quantite = intval($_POST['quantite']);
	}
	$requete_insert = "INSERT INTO courses (nom, quantite) VALUES ($nom, $quantite)";

	if( !$bdd->query($requete_insert) ){ // on execute la requete
		echo($bdd->errorInfo()[2]); // si erreur, on affiche l'erreur
	}
}


// suppression d'une ligne via $_GET
if (isset($_GET['efface_id_courses'])) {
	$id_courses   = intval($_GET['efface_id_courses']); // Ici un champ de type INT
	$requete_delete = "DELETE FROM courses WHERE id_courses = $id_courses";
	if(!$bdd->query($requete_delete)) { // On execute la requete
		echo($bdd->errorInfo()[2]); // si erreur, on affiche l'erreur
	}
}

//mise a jour de la quantite si clique sur plus +
if (isset($_GET['plus'])) {
	$id_courses = intval($_GET['plus']);
	// Gestion de la quantite
	$quantite_initiale=0;
	if (isset($_GET['quantite'])) {
		$quantite_initiale = intval($_GET['quantite']);
	}
	$nouvelle_quantite = $quantite_initiale + 1;


	$nouvelle_valeur = $nouvelle_quantite;
	$pour_ce_champ   = $id_courses;

	$requete_update = "UPDATE courses SET quantite = $nouvelle_valeur WHERE id_courses = $pour_ce_champ";
	if(!$bdd->query($requete_update)) { // On execute la requete
		echo($bdd->errorInfo()[2]); // si erreur, on affiche l'erreur
	}
}

//mise a jour de la quantite si clique sur moins -
if (isset($_GET['moins'])) {
	$id_courses = intval($_GET['moins']);
	// Gestion de la quantite
	$quantite_initiale=0;
	if (isset($_GET['quantite'])) {
		$quantite_initiale = intval($_GET['quantite']);
	}
	$nouvelle_quantite = $quantite_initiale - 1;

	$nouvelle_valeur = $nouvelle_quantite;
	$pour_ce_champ   = $id_courses;

	if ($nouvelle_quantite >= 0) {
		$requete_update = "UPDATE courses SET quantite = $nouvelle_valeur WHERE id_courses = $pour_ce_champ";
		if(!$bdd->query($requete_update)) { // On execute la requete
			echo($bdd->errorInfo()[2]); // si erreur, on affiche l'erreur
		}
	}

}


/*$Tentrees = ['nom', 'quantite'];
foreach ($Tentrees as $a_tester) {
	if (isset($_GET[$a_tester])) {
		$$a_tester = $_GET[$a_tester];
	}
	elseif (isset($_POST[$a_tester])) {
		$$a_tester = $_POST[$a_tester];
	}
	else {
		$$a_tester = FALSE;
	}

}*/



?>


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

	<script src="js/site.js" type="text/javascript"></script>
	<link href="css/style.css" rel="stylesheet" type="text/css"/>

	<style type="text/css">
		tr.checked {
		background-color: azure;
		}
		div.reussi {
			background-color: green;
			text-align: center;
			padding:10px;
			color: #FFFFFF;
		}
		div.echec {
			background-color: red;
			text-align: center;
			padding:10px;
			color: #FFFFFF;
		}
		.a_cacher {
			display: none;
		}
	</style>

</head>

<body>

	<div class="contenair">

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
		<br><br>

		<main>
			<div class="a_cacher reussi">Bravo</div>
			<div class="a_cacher echec">Echec !</div>
		</main>

		<table class="minimalistBlack">
			<thead>
				<tr>
					<th>ID de produit</th>
					<th>Nom</th>
					<th>Quantite</th>
					<th>coche</th>				
					<th>supprimer</th>
					<th>+/-</th>							
				</tr>
			</thead>	
			<tbody>

	<?php
	$sql = "SELECT * FROM courses";

	if ($req = $bdd->query($sql)) {

		$Tlignes = $req->fetchAll();
		foreach  ($Tlignes as $ligne) {

			$id = $ligne['id_courses'];
			$quantite = $ligne['quantite'];

			$get_modif = "id_modif_get=$id&nom=".$ligne['nom']."&quantite=$quantite";
			$nom_a_modifier = $ligne['nom'];

			$checked = "";
			if ($ligne['coche']) {
				$checked = "checked";
			}

						echo "<tr id='id_{$id}' class='{$checked}'>";
						echo "<td> {$ligne["id_courses"]} </td>";
						echo "<td> <a href='./courses.php?{$get_modif}'>{$id}. {$ligne["nom"]} </a></td>";
						echo "<td> {$quantite}</td>";
						echo "<td> <input  {$checked} type='checkbox' class='id_{$id} cocher' data-idmodif='{$id}'></td>";
								// corbeille				
						echo "<td> <a href='http://localhost/courses/courses.php?efface_id_courses={$id}'> <i class='fa fa-trash-o id_$id' aria-hidden='true'></i></td></a>";
								// +/-
						echo "<td> <a href='http://localhost/courses/courses.php?plus={$id}&quantite={$quantite}'>+</a> / <a href='http://localhost/courses/courses.php?moins={$id}&quantite={$quantite}'>-</a></td>";
						echo "</tr>";
					}
				}
				?>

			</tbody>


		</table>


		<main class="formulaire">

			<?php

		$id_modif='';
		$nom = '';
		$quantite = '1';
		$titre_submit= "Créer l'article";

		if (isset($_GET['id_modif_get'])) {
			$id_modif = intval($_GET['id_modif_get']);
			$nom = "";
			if (isset($_GET['nom'])) {
				$nom = $_GET['nom'];
			}
			$quantite = (isset($_GET['quantite'])) ? intval($_GET['quantite']) : 1 ;
			$titre_submit= "Modifier l'article";

		}

?>

				<form action="./courses.php" method="POST">
						<input type="hidden" value="<?php echo $id_modif ?>" name="id_modif_post">
					<div class="row">
						<div class="col-sm-6">
							<label for="nom">Ajouter un produit</label>
							<input type="text" value="<?php echo $nom ?>" class="form-control" id="nom" placeholder="Article" name="nom">
						</div>
					</div>
				
					<fieldset>
					<div class="row">
						<div class="col-sm-6">
							<label for="exampleInputPassword1">Quantité :</label>
							<input  type="number" value="<?php echo $quantite ?>" min="0" max="1200" class="form-control" id="quantite" placeholder="0" name="quantite">
						</div>
					</div>
					</fieldset><br>
					<fieldset>						
								<button type="submit" class="btn btn-default"><?php echo $titre_submit ?></button>											
					</fieldset>
				</form><br>

		</main>	

		<footer>
			<div class="alert alert-primary" role="alert">
				<p class="text-right">Copyright 2020 Tutorial Republic !!!!
				</p>
			</div>

		</footer>

	</div>
</body>

</html>