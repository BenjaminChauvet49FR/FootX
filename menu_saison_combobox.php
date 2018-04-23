<!-- Combobox de sélection d'année-->
<form method="get" action="">
	<select name="select_saison" selected=<?php echo($_SESSION['saison']); ?>>
	<?php 
		$query_listeSaisons = $bdd->query('SELECT * from saison');
		while($ligne = $query_listeSaisons->fetch()){
			echo('<option value="'.$ligne['id'].'">'.chaineSaison($ligne['annee_depart']).'</option>');
		}
	?>
	</select>
	<input type="submit" value="Aller"></input></br>
</form>