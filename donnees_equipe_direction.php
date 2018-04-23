<form method="post" action="donnees_equipe.php">
	<label for="pays">Consulter la fiche du club suivant : </label>
		<select name="select_club" id="select_club" <?php echo('selected="'.$_SESSION['num_club'].'"'); ?> >
			<?php 
				$reponse = $bdd->query('SELECT dim_nom, numero from equipe inner join equipe_saison '.
				'on id_equipe = equipe.id where id_saison = '.$_SESSION['saison'].
				' order by numero');
				while ($reponse_ligne = $reponse->fetch()){
					echo('<option value="'.$reponse_ligne['numero'].'">'.$reponse_ligne['dim_nom'].'</option>');
				}
			?>
		</select>
	<input type="submit" value="Aller"></input>
</form>

<h2>Fiche du club <?php echo($dim_nom);?> sur la saison <?php echo(chaineSaison_id($_SESSION['saison'],$bdd))?></h2>		
