<form action="anneau.php">
<label for="pays">Choix</label><?php include('transverse/combobox_saisons.php');?></br>
<select name="select_journeeA" selected="<?php echo($_SESSION['journeeA'])?>">
	<?php 
	for($i=1;$i<=38;$i++)
		echo('<option value="'.$i.'">'.$i.'</option>');
	?>
	</select>
	<select name="select_journeeB" selected="<?php echo($_SESSION['journeeB'])?>">
	<?php
	for($i=1;$i<=38;$i++) /*1910545 ce code dupliqué est moche*/
		echo('<option value="'.$i.'">'.$i.'</option>');
	?>
	</select>
	<input type="submit" value="afficher"></input>
</form>
<h3>Visualisation de l'anneau entre les journées <?php echo($_SESSION['journeeA'].' et '.$_SESSION['journeeB']); ?></h3>