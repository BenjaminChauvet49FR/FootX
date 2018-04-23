<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
		<link rel="icon" href="ballon.png">
		<!--link rel="stylesheet" href="liste_matches.css"></link-->
		<link rel="stylesheet" href="footix.css">
        <?php 
		include('datepicker.php');
		?>
        <title>Visualisation journée ligue 1</title> 
    </head>
	
	
    <body>
        <?php
			//PDO
			include('pdo.php');
			//Requêtes BDD autres que select
			include('insertion_journee_annexe.php');
			//Menu
			include('menu.php');
		?>
	
        <h2>Voir matches d'une journée</h2>		
		<?php
			echo('Journée '.$_SESSION['journee']);				
		?>
		
		<!-- Ajout des journées-->
		<form method="post" action="visualisation_journee.php">
			<p>
			<label for="pays">Se rendre à la journée n°</label>
			<select name="select_journee" id="select_journee" <?php echo('selected="'.$_SESSION['journee'].'"'); ?> >
				<?php 
					for($i=1;$i<=38;$i++)
						echo('<option value="'.$i.'">'.$i.'</option>');
				?>
			</select>
			<input type="submit" value="Aller"></input>
			</p>
		</form>
		
		
        <div id="div_rencontres">
			<!-- Voir les matches -->
			<h3>Voir matches de cette journée</h3>
			<form method="post" action="insertion_journee.php">
				<?php 
				function chaine_input_cache_matchDejaEntre($nom,$valeur){
					return ('<input type="hidden" name="'.$nom.'" value="'.$valeur.'"></input>');
				}

				function chaineButsEquipe($id_equipe,$bdd){
					$reponse = '';
					$buts = $bdd->query('SELECT * from but where id_equipe ='.$id_equipe.' and journee = '.$_SESSION['journee'].' and id_saison='.$_SESSION['saison'].' left join buts_special on but_special.id_but = but.id');
					while($buts_L = $buts->fetch())
						//$reponse = $reponse.$buts_L['minute'].(lettreTypeDeBut($buts_L['special'])).' ';
						$reponse = $reponse.$buts_L['minute'].(lettreTypeDeBut($buts_L['buts_special.special'])).' ';
					return $reponse;
				}
				
				
				$ir = 0;
				$reponse = $bdd->query('SELECT * from v_match where jour ='.$_SESSION['journee'].' ORDER by date');
				while($reponse_ligne = $reponse->fetch()){
					
					//Sélection des matches
					echo('<b>'.$reponse_ligne['date'].'</b> '.$reponse_ligne['domicile'].' '.$reponse_ligne['score_dom'].
					   ' - '.$reponse_ligne['score_ext'].' '.$reponse_ligne['exterieur'].'</br>');
					
				
				}
				?>
			</form>
        </div>
    </body>
</html>           

<!--
Données ici : http://www.lfp.fr/ligue1/calendrier_resultat#sai=100&jour=1

 
Ecrire des dates en SQL à partir de chaînes de caractères : https://dev.mysql.com/doc/refman/5.7/en/date-and-time-functions.html#function_str-to-date
(après des échecs de TO_DATE et CONVERT qui m'ont fait dire que je devais être sur une mauvaise version d'SQL. Qu'à cela ne tienne, j'ai cherché sur une doc qui avait le plus de chances d'être valide)
-->