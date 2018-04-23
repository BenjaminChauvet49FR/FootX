<!-- Formulaire d'ajout des journées-->
<form method="get" action="insertion_journee.php">
	<p>
	<?php 
		if ($_SESSION['journee'] > 1) 
			echo('<a href="insertion_journee.php?select_journee='.($_SESSION['journee']-1).'">Précédent</a></br>');
		if ($_SESSION['journee'] < 38) 
			echo('<a href="insertion_journee.php?select_journee='.($_SESSION['journee']+1).'">Suivant</a></br>');
	?>
	<label for="pays">Se rendre à la journée n°</label>
	<select name="select_journee" id="select_journee" selected="<?php echo($_SESSION['journee']); ?>">
		<?php 
			for($i=1;$i<=38;$i++)
				echo('<option value="'.$i.'">'.$i.'</option>');
		?>
	</select>
	<input type="submit" value="Aller"></input>
	</p>
</form>