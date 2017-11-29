<?php

//echo 'GET: <br>';
// pour formulaire
$Tentrees = ['fruit1' , 'fruit2'];
//var_dump($Tentrees);

foreach ($Tentrees as $a_tester) {

	if (isset($_GET[$a_tester])) {
		$$a_tester = $_GET[$a_tester];
	}
	elseif (isset($_POST[$a_tester])) {
		$$a_tester = $_POST[$a_tester];	
	}
	else {
		$$a_tester = false;
	}
}


/*
echo '<form action="test_envoie.php" method="POST">';

foreach ($Tentrees as $entree) {

	echo '<br>entree: '.$entree.' = '.$$entree;

	echo $entree.': <input type="text" name="'.$entree.'" value="'.$$entree.'" /><br>';


}

	echo '<input type="submit" value="envoyer"/>';
	echo '</form>';
*/
$bdd = new PDO('mysql:host=localhost;dbname=formation;charset=utf8', 'root', '');


//$fruit1 = bdd->quote($fruit1);
if ($fruit1) {
	$sql = "INSERT INTO fruits(nom) value ('$fruit1')";

	if ($req = bdd->query($sql)) {
		echo 'le fruit' .$fruit1. 'a été ajouté';
	}
	else echo ('Erreur MySQL:' .bdd->errorInfo()[2]);
	}

?>

<form action="" method="post">

	<input type="text" name="fruits1" value="">

	<input type="text" name="fruits2" value="">

	<input type="submit" value="envoyer">

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

else {
	print_r($bdd->errorInfo());
}

?>


</table>











	