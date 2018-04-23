<?php
$nombre_equipes = 20;
$nombre_journees = 38;
for($i=1;$i<=$nombre_equipes;$i++){
	$tableau_score_dom[$i] = array();
	$tableau_score_ext[$i] = array();
	$tableau_integrale_domination[$i] = array();
	$tableau_adversaire[$i] = array(); //Numéro de l'équipe opposée
	for($j=1;$j<=$nombre_equipes;$j++){
		if($i==$j){
			$tableau_score_dom[$i][$j] = -1;
			$tableau_score_ext[$i][$j] = -1;
		}
		else{
			$tableau_score_dom[$i][$j] = 0;
			$tableau_score_ext[$i][$j] = 0;					
		}
		$tableau_journee_rencontre[$i][$j] = -1;
		$tableau_integrale_domination[$i][$j] = 0;
	}
	for($jour=1;$jour<=$nombre_journees;$jour++){
		$tableau_bp[$i][$jour]=0;
		$tableau_bc[$i][$jour]=0;
		$tableau_pts[$i][$jour]=0;
		$tableau_idd[$i][$jour]=0;
		$tableau_bp_1_15[$i][$jour]=0;
		$tableau_bp_16_30[$i][$jour]=0;
		$tableau_bp_31_45[$i][$jour]=0;
		$tableau_bp_46_60[$i][$jour]=0;
		$tableau_bp_61_75[$i][$jour]=0;
		$tableau_bp_76_89[$i][$jour]=0;
		$tableau_bp_90[$i][$jour]=0;
		$tableau_bc_1_15[$i][$jour]=0;
		$tableau_bc_16_30[$i][$jour]=0;
		$tableau_bc_31_45[$i][$jour]=0;
		$tableau_bc_46_60[$i][$jour]=0;
		$tableau_bc_61_75[$i][$jour]=0;
		$tableau_bc_76_89[$i][$jour]=0;
		$tableau_bc_90[$i][$jour]=0;
		$tableau_score_apres_45[$i][$jour]=1; //Points de victoire après 45 minutes (3 si l'équipe mène, 1 si égalité, 0 si menée)
		$tableau_score_apres_60[$i][$jour]=1; //Points de victoire après 60 minutes (3 si l'équipe mène, 1 si égalité, 0 si menée)
		$tableau_score_apres_75[$i][$jour]=1; //Points de victoire après 75 minutes (3 si l'équipe mène, 1 si égalité, 0 si menée)
		$tableau_score_apres_90[$i][$jour]=1; //Points de victoire jusqu'à la 89ème minute
		$tableau_ecart_positif[$i][$jour]=0; //Nombre de buts par lequel l'équipe a mené au score
		$tableau_ecart_negatif[$i][$jour]=0; //Nombre de buts par lequel l'équipe a été menée au score
	}
}

//Toute la partie process des doubles confrontations.
include("saison_double_confrontation.php");

$requete = 'select * from v_equipe_saison where id_saison = '.$_SESSION['saison'].' order by numero';
//echo_sql($requete);
$equipes = $bdd->query($requete);
$numero = 1;
while($equipe = $equipes->fetch()){
	$tableau_equipe_dim_nom[$numero]=$equipe['dim_nom'];
	$numero++;
}

$requete = 'select * from but 
right join matchs on (but.num_equipe in (matchs.num_eq_dom,matchs.num_eq_ext) and but.journee = matchs.journee and but.id_saison = matchs.id_saison)
left join but_special on (but.id = but_special.id_but)
where matchs.id_saison = '.$_SESSION['saison'].' order by matchs.journee, but.minute';
//echo_sql($requete);
$reponse_buts = $bdd->query($requete);
include('transverse/integrale_domination.php');
while($but = $reponse_buts->fetch()){
	$journee = $but['journee'];
	$minute = $but['minute'];
	$montant_idd = 90 - $minute;
	$num_eq_marque = $but['num_equipe'];
	$num_eq_dom = $but['num_eq_dom'];
	$num_eq_ext = $but['num_eq_ext'];	
	$tableau_adversaire[$num_eq_ext][$journee] = $num_eq_dom;
	$tableau_adversaire[$num_eq_dom][$journee] = $num_eq_ext;
	
	$num_eq_encaisse= ($num_eq_marque == $num_eq_dom ? $num_eq_ext : $num_eq_dom);
	if($num_eq_marque == $num_eq_dom){
		$tableau_score_dom[$num_eq_dom][$num_eq_ext]++;
		$tableau_bp[$num_eq_dom][$journee]++;
		$tableau_bc[$num_eq_ext][$journee]++;
		$tableau_idd[$num_eq_dom][$journee] += $montant_idd;
		$tableau_idd[$num_eq_ext][$journee] -= $montant_idd;
		$tableau_integrale_domination[$num_eq_dom][$num_eq_ext] += $montant_idd;
	}
	if($num_eq_marque == $num_eq_ext){ //Un simple if/else ne permet pas de prendre en compte le cas où le numéro est à null... puisque la requête est une jointure "right", pas "inner".
		$tableau_score_ext[$num_eq_dom][$num_eq_ext]++;			
		$tableau_bp[$num_eq_ext][$journee]++;
		$tableau_bc[$num_eq_dom][$journee]++;
		$tableau_idd[$num_eq_dom][$journee] -= $montant_idd;
		$tableau_idd[$num_eq_ext][$journee] += $montant_idd;
		$tableau_integrale_domination[$num_eq_dom][$num_eq_ext] -= $montant_idd;		
	}
	if ($num_eq_marque != null){ 
		if ($minute <= 15){
			$tableau_bp_1_15[$num_eq_marque][$journee]++;
			$tableau_bc_1_15[$num_eq_encaisse][$journee]++;
		}
		if (15 < $minute && $minute <= 30){
			$tableau_bp_16_30[$num_eq_marque][$journee]++;
			$tableau_bc_16_30[$num_eq_encaisse][$journee]++;
		}
		if (30 < $minute && $minute <= 45){
			$tableau_bp_31_45[$num_eq_marque][$journee]++;
			$tableau_bc_31_45[$num_eq_encaisse][$journee]++;
		}
		if (45 < $minute && $minute <= 60){
			$tableau_bp_46_60[$num_eq_marque][$journee]++;
			$tableau_bc_46_60[$num_eq_encaisse][$journee]++;
		}
		if (60 < $minute && $minute <= 75){
			$tableau_bp_61_75[$num_eq_marque][$journee]++;
			$tableau_bc_61_75[$num_eq_encaisse][$journee]++;
		}
		if (75 < $minute && $minute <= 89){
			$tableau_bp_76_89[$num_eq_marque][$journee]++;
			$tableau_bc_76_89[$num_eq_encaisse][$journee]++;
		}
		if ($minute == 90){
			$tableau_bp_90[$num_eq_marque][$journee]++;
			$tableau_bc_90[$num_eq_encaisse][$journee]++;
		}
	}

	if ($tableau_journee_rencontre[$num_eq_dom][$num_eq_ext] == -1){
		$tableau_journee_rencontre[$num_eq_dom][$num_eq_ext] = $journee;
		$tableau_joue_dom[$num_eq_dom][$journee]=1;
		$tableau_joue_dom[$num_eq_ext][$journee]=0; //Avant, le tableau "tableau_joue_dom" était géré dessous, ce qui donnait des tableaux assez bizarres. SCO 1,1,1,...,0 ; SCB 0,1,1,...,0
	}
}

for($num_dom=1;$num_dom<=$nombre_equipes;$num_dom++){
	for($num_ext=1;$num_ext<=$nombre_equipes;$num_ext++){
		if($num_dom != $num_ext){
			$journee = $tableau_journee_rencontre[$num_dom][$num_ext];
			$score_dom = $tableau_score_dom[$num_dom][$num_ext];
			$score_ext = $tableau_score_ext[$num_dom][$num_ext];
			if($score_dom > $score_ext){
				$tableau_pts[$num_dom][$journee]=3;
				$tableau_pts[$num_ext][$journee]=0;
			}
			else{
				if($score_dom == $score_ext){
					$tableau_pts[$num_dom][$journee]=1;
					$tableau_pts[$num_ext][$journee]=1;
				}
				else{
					$tableau_pts[$num_dom][$journee]=0;
					$tableau_pts[$num_ext][$journee]=3;
				}
			}
		}
	}
}



include('variables_sessions_stats_saison_out.php'); //Nom incorrect !
?>