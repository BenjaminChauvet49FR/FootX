<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
		<link rel="icon" href="ballon.png">
		<link rel="stylesheet" href="liste_matches.css">
        <?php 
		$chemin_commun = '../commun';
		include($chemin_commun.'/infos_head.php'); 
		include('datepicker.php');
		?>
        <title>Visualiser anneau ligue 1</title> 
    </head>
	
	
    <body>
		<?php 
		include('menu.php'); 
		include('pdo.php');
		include('anneau_variables_session.php');
		?>
		</br>
		<?php
		include('anneau_direction.php'); 
		include('anneau_calcul_affichage.php');
		?>
	</body>
</html>