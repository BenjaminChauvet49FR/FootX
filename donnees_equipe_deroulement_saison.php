<div>
	<h3>Déroulement d'une saison</h3>
	<?php 
		$total_integrale_domination = 0;
		$meilleure_idd = 0;
		$pire_idd = 0;
		$dim_nom_adversaire_meilleure_idd = '';
		$dim_nom_adversaire_pire_idd = '';
		$journee_meilleure_idd = 0;
		$journee_pire_idd = 0;
		$requete = 'SELECT dom.numero as dom_numero,ext.numero as ext_numero,score_dom,score_ext,dim_nom_dom,dim_nom_ext,journee from v_match '.
		'inner join v_equipe_saison as dom on (dom.id_saison = v_match.id_saison and dom.dim_nom = v_match.dim_nom_dom) '.
		'inner join v_equipe_saison as ext on (ext.id_saison = v_match.id_saison and ext.dim_nom = v_match.dim_nom_ext) '.
		'where (dim_nom_dom = \''.$dim_nom.'\' or dim_nom_ext = \''.$dim_nom.'\') and v_match.id_saison = '.$_SESSION['saison'].' '.
		'order by v_match.journee';
		$reponse = $bdd->query($requete);
		echo('<table>');
		while ($reponse_ligne = $reponse->fetch()){
			echo('<tr>');
			$score_dom = $reponse_ligne['score_dom'];
			$score_ext = $reponse_ligne['score_ext'];	
			$num_dom = $reponse_ligne['dom_numero'];
			$num_ext = $reponse_ligne['ext_numero'];
			$integrale_domination_pdv = integrale_domination($_SESSION['saison'],$reponse_ligne['journee'],$num_dom,$num_ext,$bdd);
			$domicile = true;
			if ($num_ext == $_SESSION['num_club']){
				$domicile = false;
				$integrale_domination_pdv = -$integrale_domination_pdv;
			}
			echo('<td>'.$reponse_ligne['dim_nom_dom'].'</td><td>'.$score_dom.'</td><td>'.$score_ext.'</td><td>'.
				 $reponse_ligne['dim_nom_ext'].'</td><td>'.$integrale_domination_pdv.'</td>');
			echo('</tr>');
			//Pour les stats
			$total_integrale_domination += $integrale_domination_pdv;
			if ($integrale_domination_pdv > $meilleure_idd){
				$meilleure_idd = $integrale_domination_pdv;		
				$journee_meilleure_idd = $reponse_ligne['journee'];
				$dim_nom_adversaire_meilleure_idd = $domicile ? $reponse_ligne['dim_nom_ext'] : $reponse_ligne['dim_nom_dom'];
			}
			if ($integrale_domination_pdv < $pire_idd){
				$pire_idd = $integrale_domination_pdv;				
				$journee_pire_idd = $reponse_ligne['journee'];
				$dim_nom_adversaire_pire_idd = $domicile ? $reponse_ligne['dim_nom_ext'] : $reponse_ligne['dim_nom_dom'];
			}
		}
		echo('</table>');
	?>
	
	<h3>Stats sur la saison</h3>
	Intégrale de domination totale : <?php echo($total_integrale_domination) ?> (moyenne) : <?php echo($total_integrale_domination/38.0) ?></br>
	Meilleure IDD : <?php echo($meilleure_idd) ?> BM 
	(obtenue face à <?php echo($dim_nom_adversaire_meilleure_idd) ?> lors de la J<?php echo($journee_meilleure_idd) ?>)</br>
	Pire IDD : <?php echo($pire_idd) ?> BM
	(obtenue face à <?php echo($dim_nom_adversaire_pire_idd) ?> lors de la J<?php echo($journee_pire_idd) ?>)</br>
</div>