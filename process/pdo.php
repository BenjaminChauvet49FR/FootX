<?php try{
	$bdd = new PDO('mysql:host=localhost;dbname=ligue_1_2016_2017;charset=utf8', 'root', 'lalala858585');
}
catch(Exception $e){
	die('Erreur : '.$e->getMessage());
}	?>