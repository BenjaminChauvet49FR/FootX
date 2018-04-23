<h3>Voir/éditer/supprimer matches journée <?php echo ($_SESSION['journee'])?></h3>
<form method="post" action="insertion_journee.php">
		<?php 
		function chaineButsEquipe($num_equipe,$bdd){
			$reponse = '';
			$buts = $bdd->query('SELECT * from but left join but_special on but_special.id_but = but.id
			left join but_temps_additionnel on but_temps_additionnel.id_but = but.id
			where num_equipe ='.$num_equipe.' and journee = '.$_SESSION['journee'].' and id_saison='.$_SESSION['saison']);
			while($buts_L = $buts->fetch()){
				$but_extra = '';
				if ($buts_L['id_but'] != null){
					$but_extra = '+'.$buts_L['minute_plus'];
				}
				$reponse = $reponse.$buts_L['minute'].$but_extra.(lettreTypeDeBut($buts_L['special'])).' ';
			}
			return $reponse;
		}
		
		
		$ir = 0;
		$reponse = $bdd->query('SELECT * from matchs where journee ='.$_SESSION['journee'].' and id_saison='.$_SESSION['saison'].' ORDER by date');
		while($reponse_ligne = $reponse->fetch()){
			
			//Sélection des matches
			$equipeDom = $bdd->query('SELECT * from v_equipe_saison where id_saison='.$_SESSION['saison'].' and numero='.$reponse_ligne['num_eq_dom'])->fetch();
			$equipeExt = $bdd->query('SELECT * from v_equipe_saison where id_saison='.$_SESSION['saison'].' and numero='.$reponse_ligne['num_eq_ext'])->fetch();
			
			//Chaine de buts	
			$chaineButs = chaineButsEquipe($equipeDom['numero'],$bdd).';'.chaineButsEquipe($equipeExt['numero'],$bdd);
			?>
			<input type="checkbox" id="checkbox_matchDejaEntre<?php echo($ir)?>" name="checkbox_matchDejaEntre<?php echo($ir)?>"></input>
			<input type="hidden" name = "input_cache_matchDejaEntreDom<?php echo($ir)?>" value=<?php echo($reponse_ligne['num_eq_dom']) ?>></input>
			<?php echo($reponse_ligne['date'])?> --- 
			<?php logo($equipeDom['dim_nom'],16);echo($equipeDom['dim_nom']);?>
			<input type="text" name="input_matchDejaEntre<?php echo($ir)?>" value="<?php echo($chaineButs)?>"></input>
			<?php echo($equipeExt['dim_nom']);logo($equipeExt['dim_nom'],16).' '?>
			<input type="hidden" name="input_cache_matchDejaEntreExt<?php echo($ir)?>" value=<?php echo($reponse_ligne['num_eq_ext']) ?>></input>
			</br>
		
			<?php 
			$ir++;
		}
		?>
		<input type="submit" name="action" id="submit_modification" value="Modification"></input>
		<input type="submit" name="action" id="submit_suppression" value="Suppression"></input>
	</form>
</div>