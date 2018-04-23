<?php
//Pour faciliter les recherches, on donne la journée et les numéros des équipes domicile et extérieur, même si c'est redondant
function integrale_domination($id_saison,$journee,$num_eq_dom,$num_eq_ext,$bdd){
	$requete = 'select num_equipe,minute from but where '.
	'journee='.$journee.' and id_saison='.$id_saison.' and num_equipe in ('.$num_eq_dom.','.$num_eq_ext.') '. 
	'order by minute';
	$recherche_buts = $bdd->query($requete);
	$total = 0;
	while($but_ligne = $recherche_buts->fetch()){
		if($but_ligne['num_equipe'] == $num_eq_dom){
			$total += (90-$but_ligne['minute']);				
		}
		else{
			$total -= (90-$but_ligne['minute']);						
		}
	}
	return($total);
}
?>