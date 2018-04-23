<?php session_start();?>
<!DOCTYPE html>

<?php header("Cache-Control: no-cache, no-store, must-revalidate");?>
<html>
    <head>
		<link rel="icon" href="ballon.png">
		<link rel="stylesheet" href="footix.css">
        <?php include('datepicker.php'); ?>
        <title>Insertion Ligue 1</title> 
    </head>
	
	
	
    <body>
        <?php
			include('process/main_process.php');
			include('insertion_journee_annexe.php'); 			//Requêtes BDD autres que select
			include('images/images.php');
			include('saison/variables_session.php');
			include('header.php'); 
		?>
		<section>
			<?php
				include('menu.php'); //Menu
			?>
			<div id="principal">
				<?php
					include('insertion_journee_direction.php'); 
					include('insertion_journee_insertions.php'); 
					include('insertion_journee_editions.php'); 
				?>	
			</div>
		<section>
		<script src="insertion_journee_permuter.js"></script>
		<script src="insertion_journee_schemas.js"></script>
    </body>
</html>           

<!--
Données ici : http://www.lfp.fr/ligue1/calendrier_resultat#sai=100&jour=1

 
Ecrire des dates en SQL à partir de chaînes de caractères : https://dev.mysql.com/doc/refman/5.7/en/date-and-time-functions.html#function_str-to-date
(après des échecs de TO_DATE et CONVERT qui m'ont fait dire que je devais être sur une mauvaise version d'SQL. Qu'à cela ne tienne, j'ai cherché sur une doc qui avait le plus de chances d'être valide)
-->