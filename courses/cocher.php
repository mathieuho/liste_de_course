<?php

$id_courses = 0;
if (isset($_GET['id_courses'])) {
	$id_courses = intval($_GET['id_courses']);
}

$coche = 0;
if (isset($_GET['coche']) and $_GET['coche'] == 'oui') {
	$coche = 1;
}


//if ($id_courses) {
if ($id_courses > 0) {
	$bdd = new PDO('mysql:host=localhost;dbname=liste_courses;charset=utf8', 'root', '');

	$requete_update = "UPDATE courses SET coche = $coche WHERE id_courses = $id_courses";

/*	if (isset($_GET['nouveau_nom']) and $_GET['nouveau_nom'] != '') {
		$nouveau_nom = $_GET['nouveau_nom'];
		$nouveau_nom = $bdd->quote($nouveau_nom);
		$requete_update = "UPDATE courses SET coche = $coche, nom = $nouveau_nom WHERE id_courses = $id_courses";
	}
*/
	if(!$bdd->query($requete_update)) { // On execute la requete
		echo($bdd->errorInfo()[2]); // si erreur, on affiche l'erreur
	}

	/*echo "alert('ok'); var toto='oui'; ";
} else {
	echo "alert('perdu');";*/
}
