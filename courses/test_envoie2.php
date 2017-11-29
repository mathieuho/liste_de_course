<?php
//var_dump($_POST);

$Tentrees = ['fruit1', 'fruit2'];
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

}


$bdd = new PDO('mysql:host=localhost;dbname=formation;charset=utf8', 'root', '');

//$fruit1 = bdd->quote($fruit1);
/*if ($fruit1) {
	$sql = "INSERT INTO fruits (nom) VALUE ('$fruit1')";

	if ($req = $bdd->query($sql)) {
		echo 'le fruit '.$fruit1.' a été ajouté';
	}
	else echo('Erreur MySQL: '.$bdd->errorInfo()[2]);
}*/
/*
if ($fruit2) {
	$sql = "INSERT INTO fruits (nom) VALUE ('$fruit2')";

	if ($req = $bdd->query($sql)) {
		echo 'le fruit '.$fruit2.' a été ajouté';
	}
	else echo('Erreur MySQL: '.$bdd->errorInfo()[2]);
}
*/
// vérifier si le produit existe dans la base
if ($fruit1)  {
	$fruit1 = $bdd->quote($fruit1);

	$sql = "SELECT * FROM fruits WHERE nom = $fruit1";
	if ($req = $bdd->query($sql)) {
		$Tlignes = $req->fetchAll();

		if (count($Tlignes) != 0) {
			echo 'ce fruit exite déjà';
		}
		else {
			$sql = "INSERT INTO fruits (nom) VALUE ('$fruit1')";

			if ($req = $bdd->query($sql)) {
				echo 'le fruit '.$fruit1.' a été ajouté';
			}
			else echo('Erreur MySQL: '.$bdd->errorInfo()[2]);
		}
	}

else
	echo ($bdd->errorInfo()[2]);

}
?>
<h2>Ajouter un fruit</h2>
<form action="test_envoie2.php" method="post">
	Fruit 1: <input type="text" name="fruit1" value="" />
	<br>
<!--	Fruit 2: <input type="text" name="fruit2" value="" /> -->
	<input type="submit" value="envoyer" />
</form>

<table>
	<tr>
		<td>id_fruit</td>
		<td>nom du fruit</td>
	</tr>
	
<?php
	
$sql = "SELECT * FROM fruits";

if ($req = $bdd->query($sql)) {
	$Tlignes = $req->fetchAll();	
	foreach ($Tlignes as $ligne) {
		echo '<tr>';
		echo '<td>'.$ligne['id_fruit'].'</td>';
		echo '<td>'.$ligne['nom'].'</td>';
		echo '</tr>';
	}
}
else 
	echo 'erreur MySQL: '.$bdd->errorInfo()[2];

?>
	
</table>

<?php
/*
echo '<form action="test_envoi.php" method="post">';

foreach ($Tentrees as $entree) {
	echo '<label for="'.$entree.'">'.$entree.': ';
	echo '<input type="text" name="'.$entree.'" value="'.$$entree.'" />';
	echo '</label><br><br>';
}

echo '<input type="submit" value="envoyer" />';
echo '</form>';
*/
?>