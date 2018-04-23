<?php
//Ce fichier gère le calcul et l'affichage d'un anneau. (journée déterminée par les valeurs dans anneau_variables_sessions)
/*Renvoie un tableau avec les numéros des équipes à domicile et à l'extérieur de chaque match*/
function extraireEnTableau($journee,$bdd){
	$tabJournee = array();
	$matchs = $bdd->query('select num_eq_dom,num_eq_ext from matchs where journee = '.$journee.' and id_saison='.$_SESSION['saison']);
	$indice = 0;
	while($ligne = $matchs->fetch()){
		$tabJournee[$indice] = array(0=>$ligne['num_eq_dom'],1=>$ligne['num_eq_ext']);
		$indice++;
	}
	return $tabJournee;
}


/*Transforme deux tableaux d'autant de rencontres en un tableau anneau.
Un X marque la séparation.
(3-8 5-6 1-4 7-2)
(1-3 5-8 2-7 6-4)
=>
(3,8,5,6,4,1,X,2,7)			
*/

/*
t1 :
(3-8 5-6 1-4 7-2)
=>
2,3,0,2,1,1,3,0

t2 :
(1-3 5-8 2-7 6-4)
=>
0,2,0,3,1,3,2,1

1=(t1)=>4=(t2)=>6=(t1)=>5=(t2)=>8=(t1)=>3=(t2)=>t1

*/


function transformerEnAnneau($tableauMatchesA,$tableauMatchesB){ /*1910545 attention, 20 nombre brut. */
	$pris = array();/*booléens ; indexes 1->20*/
	$inverseA = array(); /*numéros 0 à 9 ; indexes 1->20*/
	$inverseB = array(); /*numéros 0 à 9 ; indexes 1->20*/
	for($i=1;$i<=20;$i++)
		$pris[$i] = false;
	for($i=0;$i<=9;$i++){
		$inverseA[$tableauMatchesA[$i][0]] = $i;
		$inverseA[$tableauMatchesA[$i][1]] = $i;
		$inverseB[$tableauMatchesB[$i][0]] = $i;
		$inverseB[$tableauMatchesB[$i][1]] = $i;
	}
	$resultat = array(); /*Indices : 0->(19 + 1 par anneau)*/
	$longueur_resultat = 0; 
	$equipe = 1;
	$equipeNonPrise = 1;
	
	while($equipeNonPrise < 20){
		while($equipeNonPrise < 20 && ($pris[$equipeNonPrise]))
			$equipeNonPrise++;
		if($equipeNonPrise < 20){
			$equipe = $equipeNonPrise;
			while(!($pris[$equipe])){
				//Insérer match de la journée A
				$pris[$equipe] = true;
				$resultat[$longueur_resultat] = $equipe;
				$longueur_resultat++;
				//Regarder dans la journée B
				$indiceMatchAutreJournee = $inverseB[$equipe];
				$equipe = ($tableauMatchesB[$indiceMatchAutreJournee][1] == $equipe ? 
						   $tableauMatchesB[$indiceMatchAutreJournee][0] : $tableauMatchesB[$indiceMatchAutreJournee][1]);
				//Insérer match de la journée B
				$pris[$equipe] = true;
				$resultat[$longueur_resultat] = $equipe;
				$longueur_resultat++;
				//Regarder dans la journée A
				$indiceMatchAutreJournee = $inverseA[$equipe];
				$equipe = ($tableauMatchesA[$indiceMatchAutreJournee][1] == $equipe ? 
						   $tableauMatchesA[$indiceMatchAutreJournee][0] : $tableauMatchesA[$indiceMatchAutreJournee][1]);
			}
			//Insérer un séparateur
			$resultat[$longueur_resultat] = 0;
			$longueur_resultat++;
		}
	}
	return $resultat;
}

/*Affiche l'anneau constitué d'un tableau. Visuel. Aurait pu être fait en JS.*/
function afficherAnneau($anneau,$bdd){
	for($i=0;$i<sizeof($anneau);$i++){
		if($anneau[$i] == 0)
			echo('---</br>');
		else{
			$reponse = $bdd->query('select dim_nom from v_equipe_saison where id_saison='.$_SESSION['saison'].' and numero='.$anneau[$i]);
			if($reponse_ligne = $reponse->fetch()){
				echo($reponse_ligne['dim_nom'].'</br>');
			}
		}
	}
} 

//---------------
// Script principal

//Ce script affiche l'anneau tant attendu entre deux journées 
$tabJourneeA = extraireEnTableau($_SESSION['journeeA'],$bdd);
$tabJourneeB = extraireEnTableau($_SESSION['journeeB'],$bdd);
$anneau = transformerEnAnneau($tabJourneeA,$tabJourneeB);
afficherAnneau($anneau,$bdd); /*1910545 Un affichage en javascript ce serait pas mal*/
?>
