<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
		<link rel="icon" href="ballon.png">
		<link rel="stylesheet" href="liste_matches.css">
		<link rel="stylesheet" href="footix.css">
        <title>Données d'une saison</title> 
    </head>
	
	<body>
		<?php 
			include('process/main_process.php');
			include('header.php');
		?>
		<section>
		
			<?php
				include('menu.php');
			?>
			<div id="principal">	
				<?php
					include('process/saison.php');
					include('stats_saison_gros_tableau.php');
					include('stats_saison_petit_tableau_equipes.php');
				?>
			</div>
		</section>
	</body>
</html>