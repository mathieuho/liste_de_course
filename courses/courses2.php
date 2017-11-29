<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="css/layout.css" rel="stylesheet" type="text/css" />
	<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/popper.js" type="text/javascript"></script>
	<script src="js/tether.js" type="text/javascript"></script>
	<script src="js/tooltip.js" type="text/javascript"></script>
	<script src="js/modal.js" type="text/javascript"></script>
	<script src="js/popover.js" type="text/javascript"></script>
	<script src="js/bootstrap.js" type="text/javascript"></script>
	<script src="js/jquery-ui.min.js" type="text/javascript"></script>
	<link href="css/tether.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script src="js/scripts.js" type="text/javascript"></script>
	<link href="css/layout.css" rel="stylesheet" type="text/css" />
	

	<title>Ajouter un produit</title>

</head>
<?php
$bdd = new PDO('mysql:host=localhost;dbname=liste_courses;charset=utf8', 'root', '');

if (empty($_POST)){	

?>
<body>

	
	<header id="tete">
	
	</header>
		
	<main class="container">
		<div class="row" style="margin-top: 2rem;margin-bottom: 2rem;">
  			<div class="col-sm-10">
				<form action="ajout.php" method="POST">
					<legend>Faites vos courses<br><br></legend>	
					<fieldset class="form-group">
						<p><label for="nom" class="col-sm-2">Nom :</label>
						<input class="form-control col-sm-10" type="text" name="nom" id="nom" title="Nom du produit" required minlength=3 />
						</p>
						<p><label for="quantite" class="col-sm-2">Quantité :</label>
						<input class="form-control col-sm-10" type="text" name="quantite" id="quantite"/>
						</p>
						<p><label for="unite" class="col-sm-2">Unité :</label>
						
						<select id="leunite" name="leunite" class="form-control col-sm-6">
							<option value='unité'>Unité
							<option value='gramme'>Gramme
							<option value='kilogramme'>Kilogramme
							<option value='centilitre'>Centilitre
							<option value='litre'>Litre
						</select>

						</p>
			</div>		
					</fieldset>
					<div class="col-sm-6">
						<input type="reset" name="reinit" value="Recommencer">
					</div>
					<div class="col-sm-6">
						<input type="submit" name="envoie" value="Enregistrer">
					</div>
				</form>
 <?php
} // fin if empty post

//if (!empty($_POST))
else
{
	var_dump($_POST);

$prod=strip_tags($_POST['nom']);
$quant=strip_tags($_POST['quantite']);
$unit=strip_tags($_POST['leunite']);
$requete3 = "INSERT INTO produit (nom,quantite,unite) VALUE (".$prod.",".$quant.",".$unit.")";
$bdd->query($requete3);
}

?>
	</div>

	</main>
	<footer class="footer" id="fin">
	</footer>
	<script>
	charge_bloc ("#tete");
	charge_bloc ("#fin");
	lemenutitre= (window.location.pathname).split('/').pop();
	trouve_la_page(lemenutitre);



	</script>

</body>
</html>

