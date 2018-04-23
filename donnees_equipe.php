<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
		<link rel="icon" href="ballon.png">
		<link rel="stylesheet" href="liste_matches.css">
		<link rel="stylesheet" href="footix.css">
        <?php 
 
		include('datepicker.php');
		?>
        <title>Données des équipes</title> 
    </head>
	
    <body>
        <?php
			//PDO
			include('pdo.php');
			include('donnees_equipe_annexe.php');
			include('transverse/integrale_domination.php');
			include('images/images.php');
			include('saison/variables_session.php');
			include('header.php'); //Le header		
		?>
		
		
		<section>
			<?php
				include('menu.php'); //Menu
			?>
			<div id="principal">
				<?php 
					$requete_nom = $bdd->query('select dim_nom from v_equipe_saison where id_saison = '.$_SESSION['saison'].' and numero = '.$_SESSION['num_club'])->fetch();
					$dim_nom = $requete_nom['dim_nom'];
				?>
				<?php 
					include('donnees_equipe_direction.php');
					include ('donnees_equipe_deroulement_saison.php');
				?>
			</div>
		</section>
    </body>
</html>           

<!--
Données ici : http://www.lfp.fr/ligue1/calendrier_resultat#sai=100&jour=1

 
Ecrire des dates en SQL à partir de chaînes de caractères : https://dev.mysql.com/doc/refman/5.7/en/date-and-time-functions.html#function_str-to-date
(après des échecs de TO_DATE et CONVERT qui m'ont fait dire que je devais être sur une mauvaise version d'SQL. Qu'à cela ne tienne, j'ai cherché sur une doc qui avait le plus de chances d'être valide)
-->