<h3>Insérer matches journée <?php echo ($_SESSION['journee'])?></h3>	
<div id="div_rencontres">
	<!-- Schéma -->
	Définir un schéma :
	<select name="select_schema" id="select_schema"></select>
	<input type="text" class="datepicker" id="input_dateSchema" value="11/08/2017">
	<input type="text" id="input_heureMultiplexeGeneralSchema" value="20:45">
	<span id="span_clic_appliquerSchema">Cliquer ici</span></br>
	
	<!--Formulaire d'ajout des confrontations (CT_NB_RENCONTRES en principe égal à 10) (balises checkbox, span et input) -->
	<form method="post" action="insertion_journee.php">
		<?php 			
			function chaine_input_cache($dim_nom,$domOuExt,$ir){
				return ('<input class="input_cache_span_equipe" type="hidden" value="'.$dim_nom.'" name="'.$domOuExt.$ir.'"></input>');
			}
			
			function chaine_span($dim_nom){
				return ('<span class="span_equipe" style="display:inline-block; width:50px;">'.$dim_nom.'</span>');	
			}

			$indice_rencontre = 0;		
			$reponse = $bdd->query('SELECT dim_nom from equipe inner join equipe_saison where id_saison = '.$_SESSION['saison'].
			//$reponse = $bdd->query('SELECT dim_nom from equipe inner join equipe_saison where id_saison = '.$saison.
			' and equipe.id = equipe_saison.id_equipe order by equipe_saison.numero');		
			
			while ($reponse_ligne = $reponse->fetch()){
				//Checkbox, date, heure
				echo('<input type="checkbox" name="checkbox_nouveauMatch'.$indice_rencontre.'"></input>'); 
				echo('Date : <input type="text" class="datepicker" name="date'.$indice_rencontre.'"> ');
				echo('Heure : <input type="text" class="heure" value="00:00" name="heure'.$indice_rencontre.'">');	
				//Equipe 1
				echo(chaine_input_cache($reponse_ligne['dim_nom'],'ed',$indice_rencontre));
				echo(chaine_span($reponse_ligne['dim_nom']));									
				//Buts
				echo('<input name="input_butsNouveauMatch'.$indice_rencontre.'" value=";"></input>');
				//Equipe 2
				$reponse_ligne = $reponse->fetch();
				echo(chaine_input_cache($reponse_ligne['dim_nom'],'eex',$indice_rencontre));
				echo(chaine_span($reponse_ligne['dim_nom']));
				echo('</br>');					
				//Augmenter l'indice, comme dans une boucle for //4 36 57;52c
				$indice_rencontre++;
			}
		?>
		<input type="submit" value="Insertion"></input>
	</form>
