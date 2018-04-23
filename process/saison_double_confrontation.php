<?php
//Toute la partie process des doubles confrontations.
//Appelé par le script process principal, une fois connus les scores dom et ext

//Lettre 1 : match à domicile - lettre 2 : match à l'extérieur. (ND = nul à domicile, défaite à l'extérieur)
$VV = 20;$DD = -20;
$VDbPlus = 1; $VDbMoins = -1;
$VDbExtPlus = 2; $VDbExtMoins = -2;
$DVbPlus = 3; $DVbMoins = -3;
$DVbExtPlus = 4; $DVbExtMoins = -4;
$VN = 10; $ND = -10;
$NV = 11; $DN = -11;
$VDneutralite=100;
$NNneutralite=101;
$DVneutralite=102;

for($e1=2;$e1<=$nombre_equipes;$e1++)
	for($e2=1;$e2<$e1;$e2++){
		$scoreE1dom = $tableau_score_dom[$e1][$e2];
		$scoreE1ext = $tableau_score_ext[$e1][$e2];
		$scoreE2dom = $tableau_score_dom[$e1][$e2];
		$scoreE2ext = $tableau_score_ext[$e1][$e2];
		$bilanMatchE1dom = $scoreE1dom-$scoreE2ext; //Bilan du match E1 dom - E2 ext du point de vue de E1
		$bilanMatchE2dom = $scoreE2dom-$scoreE1ext;//Idem à l'envers
		
		if ($bilanMatchE1dom > 0){
			if ($bilanMatchE2dom < 0){
				$resultat = $VV;
			}else if($bilanMatchE2dom == 0){
				$resultat = $VN;
			}else{ // VD
				$totalE1 = $scoreE1dom+$scoreE1ext;
				$totalE2 = $scoreE2dom+$scoreE2ext;
				if ($totalE1 > $totalE2){
					$resultat = $VDbPlus;
				}else if($totalE1 < $totalE2){
					$resultat = $VDbMoins;
				}else{
					if ($scoreE1ext > $scoreE2ext){
						$resultat = $VDbExtPlus;
					}else if($scoreE1ext < $scoreE2ext){
						$resultat = $VDbExtMoins;
					}else{
						$resultat = $VDneutralite;
					}		
				} 
			}
		}
		else if ($bilanMatchE1dom < 0){
			if ($bilanMatchE2dom > 0){
				$resultat = $DD;
			}else if($bilanMatchE2dom == 0){
				$resultat = $DN;
			}else{ //DV
				$totalE1 = $scoreE1dom+$scoreE1ext;
				$totalE2 = $scoreE2dom+$scoreE2ext;
				if ($totalE1 > $totalE2){
					$resultat = $DVbPlus;
				}else if($totalE1 < $totalE2){
					$resultat = $DVbMoins;
				}else{
					if ($scoreE1ext > $scoreE2ext){
						$resultat = $DVbExtPlus;
					}else if($scoreE1ext < $scoreE2ext){
						$resultat = $DVbExtMoins;
					}else{
						$resultat = $DVneutralite;
					}		
				}
			}
		} else{ //Nul à domicile
			if ($bilanMatchE2dom < 0){
				$resultat = $NV;
			}else if ($bilanMatchE2dom > 0){
				$resultat = $ND;
			}else{
				if ($scoreE1ext > $scoreE2ext){
						$resultat = $NNbExtPlus;
					}else if($scoreE1ext < $scoreE2ext){
						$resultat = $NNbExtMoins;
					}else{
						$resultat = $NNneutralite;
					}		
			}
		}
			
		//Ouf, on a process !
		$tableau_double_confrontation[$e1][$e2] = $resultat;
		if(($resultat != $VDneutralite) && ($resultat != $NNneutralite) && ($resultat != $DVneutralite)){
			$tableau_double_confrontation[$e2][$e1] = -$resultat;
		}
		else{
			$tableau_double_confrontation[$e2][$e1] = $resultat;
		}		
	}
	
