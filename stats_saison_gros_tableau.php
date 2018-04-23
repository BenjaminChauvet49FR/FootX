Voir le tableau suivant :</br>
<select id="select_gros_tableau">
<option value="0">Résultats</option>
<option value="1">Journées</option>
<option value="2">IdD</option>
</select>

<table id="table_gros_tableau"><tr><td>-</td>
<?php
for($i=1;$i<=$nombre_equipes;$i++){
	echo('<td>'.$tableau_equipe_dim_nom[$i].'</td>');
}?>
</tr>


<?php for($i=1;$i<=$nombre_equipes;$i++){ ?>
	<tr><td> <?php echo($tableau_equipe_dim_nom[$i]) ?></td>
	<?php for($j=1;$j<=$nombre_equipes;$j++){ 
		$chaine_style='';
		//Si on est en mode "double confrontation"
		//Si on n'est pas en mode "double confrontation"
		if($i==$j){
			$chaine_scores = '---';
		}
		else{
			$ecart = $tableau_score_dom[$i][$j]-$tableau_score_ext[$i][$j];
			if($ecart > 3){$chaine_style ='dompppp';}
			if($ecart == 3){$chaine_style ='domppp';}
			if($ecart == 2){$chaine_style ='dompp';}
			if($ecart == 1){$chaine_style ='domp';}
			if($ecart == 0){
				if($tableau_score_dom[$i][$j] == 0){$chaine_style ='nulv';}
				else{$chaine_style ='nulnv' ;}	
			}
			if($ecart == -1){$chaine_style ='extp';}
			if($ecart == -2){$chaine_style ='extpp';}
			if($ecart == -3){$chaine_style ='extppp';}
			if($ecart < -3){$chaine_style ='extpppp';}
			if($tableau_journee_rencontre[$i][$j] == -1){
				$chaine_style='ndplm';
			} 
		}
		echo('<td class="'.$chaine_style.'"></td>');		
	} ?>
	</tr>
<?php } ?>


</table>



<?php 
include("transverse/php_js/tableau_chaine.php");


for($i=1;$i<=$nombre_equipes;$i++){
	$chaine_tableau_score_dom[$i] = tableau_vers_chaine($tableau_score_dom[$i]);
	$chaine_tableau_score_ext[$i] = tableau_vers_chaine($tableau_score_ext[$i]);
	$chaine_tableau_integrale_domination[$i] = tableau_vers_chaine($tableau_integrale_domination[$i]);
	$chaine_tableau_journees[$i] = tableau_vers_chaine($tableau_journee_rencontre[$i]);
}
?>


<script>
var tableau_dom = [];
var tableau_ext = [];
var tableau_journees = [];
var tableau_integrale_domination = [];
var tableau_points= [];
var tableau_joue_dom = [];
</script>
<?php
echo('<script>');
for($i=1;$i<=$nombre_equipes;$i++){
	/*ATTENTION : la chaîne k (k = 0..nombre_equipes, indice javascript) correspond aux données de l'équipe n° ($i) en BDD (donc de 1 à nombre_equipes
	Par contre, chaque chaîne correspond à une ligne avec le nom d'équipe en indice 0 (j'ai essayé de faire un truc à base de slice, j'ai pas réussi !)
	*/
	echo('tableau_dom.push(chaine_vers_tableau("'.$chaine_tableau_score_dom[$i].'"));');
	echo('tableau_ext.push(chaine_vers_tableau("'.$chaine_tableau_score_ext[$i].'"));');	
	echo('tableau_journees.push(chaine_vers_tableau("'.$chaine_tableau_journees[$i].'"));');	
	echo('tableau_integrale_domination.push(chaine_vers_tableau("'.$chaine_tableau_integrale_domination[$i].'"));');		
}
echo('</script>');
?>
<script>
function donnees(mode,i,j){
	if(tableau_journees[i][j] == -1){
		return "-";			
	}
	else{
		switch (mode){
			case 0:
				return tableau_dom[i][j]+"-"+tableau_ext[i][j];	//Scores
			break;
			case 1:
				return "J"+tableau_journees[i][j];	//Journées de la rencontre
			break;
			case 2:
				return tableau_integrale_domination[i][j];	//IDD
			break;
			default:
				return i+"-"+j;
			break;	
		}	
	}
}

var nb_equipes = 20;

function affichage_gros_tableau(mode){
	var gros_tableau = document.getElementById("table_gros_tableau");
	var noeud_tr;
	for (i=1;i<=nb_equipes;i++){
		for(j=1;j<=nb_equipes;j++){
			if(i != j){
				gros_tableau.children[0].children[i].children[j].innerHTML = donnees(mode,i-1,j);		
			}
		}
	}	
}

affichage_gros_tableau(0);

noeud_select_gros_tableau = document.getElementById("select_gros_tableau");
noeud_select_gros_tableau.addEventListener('change',function(e){
	affichage_gros_tableau(noeud_select_gros_tableau.selectedIndex);
	console.log("Coucou !");
})
 
</script>