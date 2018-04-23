<?php
	/*
	Gestion des variables de saison
	Récupérables du select (combobox) contenu dans le menu
	*/
	if(isset($_GET['select_saison'])){ 
		$_SESSION['saison'] = $_GET['select_saison'];
	}
		
	if(!isset($_SESSION['saison'])){ 
		$_SESSION['saison'] = 1;
	}
?>

