Voir le tableau suivant :</br>
<select id="select_petit_tableau">
<option value="0">Bilan total</option>
<option value="1">Bilan domicile</option>
<option value="2">Bilan extérieur</option>
<option value="3">IDD</option> <!-- A afficher : total, IDD >0, <0, victoires malgré <0, nuls avec <0, défaites malgré >0, nuls avec >0, meilleure IDD (adv+journée), pire IDD (adv+journée)-->
<option value="4">Buts par période</option> 
<option value="100">Remontées par période</option> 
<!-- A afficher : pts gagnés après la 45ème, pts gagnés après la 60ème, pts gagnés après la 75ème, pts gagnés à la 90ème ou après
Et les pertes équivalentes
-->
<option value="101">Ouvertures de score</option> 
<!-- A afficher : scores ouverts, ouvertures encaissées, victoires après avoir ouvert, nul, défaite, points, victoire après avoir encaissé, nul, défaite, points-->
<option value="102">Mener au score</option> 
<!-- A afficher : nb de fois avoir mené, nb de fois avoir été mené, nuls après avoir mené, nul, défaite, points perdus, victoires après avoir été mené, nuls, points gagnés-->
<option value="103">Double mener au score</option> 
<!-- Idem ci-dessus mais avec deux buts d'écart-->

<!-- A afficher : buts pour/contre 0-15, 16-30, 31-45 ...-->

</select></br>


Journées : 
<select name="journee_debut" id="select_journee_debut" selected="1">
	<?php 
		for($i=1;$i<=38;$i++)
			echo('<option value="'.$i.'">'.$i.'</option>');
	?>
</select>
à 
<select name="journee_fin" id="select_journee_fin" selected="38">
	<?php 
		for($i=1;$i<=38;$i++)
			echo('<option value="'.$i.'">'.$i.'</option>');
	?>
</select>
	

<table id="table_petit_tableau" style="visibility:false;">
<!-- <tr>
<td>Club</td>
<td>J</td>
<td>Points</td>
<td>G</td>
<td>N</td>
<td>P</td>
<td>BP</td>
<td>BC</td>
<td>DdB</td>
<td>IdD</td>
<td style="display:none;">0</td>
</tr> -->

</table>
<?php for($i=1;$i<=$nombre_equipes;$i++){
	/*echo('<tr><td id="tab'.$i.'">'.$tableau_equipe_dim_nom[$i].'</td>
	<td>0</td>
	<td>38</td>
	<td>0</td>
	<td>0</td>
	<td>0</td>
	<td>1</td>
	<td>-1</td>
	<td>2</td>
	<td>3</td>
	<td style="display:none;">'.$i.'</td>
	</tr>
	');*/
	$chaine_tableau_joue_dom[$i] = tableau_vers_chaine($tableau_joue_dom[$i]);
	$chaine_tableau_bp[$i] = tableau_vers_chaine($tableau_bp[$i]);
	$chaine_tableau_bc[$i] = tableau_vers_chaine($tableau_bc[$i]);
	$chaine_tableau_pts[$i] = tableau_vers_chaine($tableau_pts[$i]);
	$chaine_tableau_idd[$i] = tableau_vers_chaine($tableau_idd[$i]);
	$chaine_tableau_adv[$i] = tableau_vers_chaine($tableau_adversaire[$i]);
	$chaine_tableau_bp_1_15[$i] = tableau_vers_chaine($tableau_bp_1_15[$i]);
	$chaine_tableau_bp_16_30[$i] = tableau_vers_chaine($tableau_bp_16_30[$i]);
	$chaine_tableau_bp_31_45[$i] = tableau_vers_chaine($tableau_bp_31_45[$i]);
	$chaine_tableau_bp_46_60[$i] = tableau_vers_chaine($tableau_bp_46_60[$i]);
	$chaine_tableau_bp_61_75[$i] = tableau_vers_chaine($tableau_bp_61_75[$i]);
	$chaine_tableau_bp_76_89[$i] = tableau_vers_chaine($tableau_bp_76_89[$i]);
	$chaine_tableau_bp_90[$i] = tableau_vers_chaine($tableau_bp_90[$i]);	
	$chaine_tableau_bc_1_15[$i] = tableau_vers_chaine($tableau_bc_1_15[$i]);
	$chaine_tableau_bc_16_30[$i] = tableau_vers_chaine($tableau_bc_16_30[$i]);
	$chaine_tableau_bc_31_45[$i] = tableau_vers_chaine($tableau_bc_31_45[$i]);
	$chaine_tableau_bc_46_60[$i] = tableau_vers_chaine($tableau_bc_46_60[$i]);
	$chaine_tableau_bc_61_75[$i] = tableau_vers_chaine($tableau_bc_61_75[$i]);
	$chaine_tableau_bc_76_89[$i] = tableau_vers_chaine($tableau_bc_76_89[$i]);
	$chaine_tableau_bc_90[$i] = tableau_vers_chaine($tableau_bc_90[$i]);
}
$chaine_tableau_dim_noms = tableau_vers_chaine($tableau_equipe_dim_nom);
 ?>


<script>
var nb_equipes = 20;
var total_points;
var jour_min = 1;
var jour_max = 38;
var tableau_bp = [];
var tableau_bc = [];
var tableau_idd= [];
var tableau_pts= [];
var tableau_joue_dom= [];
var tableau_dim_noms= [];
var tableau_adv= [];
var tableau_bp_1_15 = [];
var tableau_bp_16_30 = [];
var tableau_bp_31_45 = [];
var tableau_bp_46_60 = [];
var tableau_bp_61_75 = [];
var tableau_bp_76_89 = [];
var tableau_bp_90 = [];
var tableau_bc_1_15 = [];
var tableau_bc_16_30 = [];
var tableau_bc_31_45 = [];
var tableau_bc_46_60 = [];
var tableau_bc_61_75 = [];
var tableau_bc_76_89 = [];
var tableau_bc_90 = [];
</script>

<?php
$nombre_equipes = 20;
echo('<script>');
for($num=1;$num<=$nombre_equipes;$num++){
	echo('tableau_bp.push(chaine_vers_tableau("'.$chaine_tableau_bp[$num].'"));
		tableau_bc.push(chaine_vers_tableau("'.$chaine_tableau_bc[$num].'"));
		tableau_idd.push(chaine_vers_tableau("'.$chaine_tableau_idd[$num].'"));
		tableau_pts.push(chaine_vers_tableau("'.$chaine_tableau_pts[$num].'"));
		tableau_joue_dom.push(chaine_vers_tableau("'.$chaine_tableau_joue_dom[$num].'"));
		tableau_adv.push(chaine_vers_tableau("'.$chaine_tableau_adv[$num].'"));
		tableau_bp_1_15.push(chaine_vers_tableau("'.$chaine_tableau_bp_1_15[$num].'"));	
    	tableau_bp_16_30.push(chaine_vers_tableau("'.$chaine_tableau_bp_16_30[$num].'"));
		tableau_bp_31_45.push(chaine_vers_tableau("'.$chaine_tableau_bp_31_45[$num].'"));
		tableau_bp_46_60.push(chaine_vers_tableau("'.$chaine_tableau_bp_46_60[$num].'"));
		tableau_bp_61_75.push(chaine_vers_tableau("'.$chaine_tableau_bp_61_75[$num].'"));
		tableau_bp_76_89.push(chaine_vers_tableau("'.$chaine_tableau_bp_76_89[$num].'"));
		tableau_bp_90.push(chaine_vers_tableau("'.$chaine_tableau_bp_90[$num].'"));		
		tableau_bc_1_15.push(chaine_vers_tableau("'.$chaine_tableau_bc_1_15[$num].'"));
		tableau_bc_16_30.push(chaine_vers_tableau("'.$chaine_tableau_bc_16_30[$num].'"));
		tableau_bc_31_45.push(chaine_vers_tableau("'.$chaine_tableau_bc_31_45[$num].'"));
		tableau_bc_46_60.push(chaine_vers_tableau("'.$chaine_tableau_bc_46_60[$num].'"));
		tableau_bc_61_75.push(chaine_vers_tableau("'.$chaine_tableau_bc_61_75[$num].'"));
		tableau_bc_76_89.push(chaine_vers_tableau("'.$chaine_tableau_bc_76_89[$num].'"));
		tableau_bc_90.push(chaine_vers_tableau("'.$chaine_tableau_bc_90[$num].'"));
			');
}
echo('tableau_dim_noms = chaine_vers_tableau("'.$chaine_tableau_dim_noms.'");');
echo('</script>');
?>


<script src="transverse/js/tri_selon_colonne.js"></script>
<script>
function recuperation_donnees_noeud_tableau(noeudTableau,retraitLignes,retraitColonnes){
	var reponse = [];
	//var noeud2 = noeudTableau.children[0]; //AVANT !
	var noeud2 = noeudTableau;
	var longueurLigne = noeud2.children[0].children.length;
	var ligne;
	for(iLigne=retraitLignes;iLigne<noeud2.children.length;iLigne++){
		ligne = [];
		for(iCol=retraitColonnes;iCol<longueurLigne;iCol++){
			ligne.push(noeud2.children[iLigne].children[iCol].innerHTML);
		}
		reponse.push(ligne);
	}
	return reponse;
	/*Bon à savoir :
	Avant on avait :
	petit_tableau.children[0] = <tbody>...</tbody> 
	petit_tableau.children[0].children[0] = <tr>...</tr>
	
	*/
	
}
</script>
<script>
console.log("Bonjour !");
var petit_tableau = document.getElementById("table_petit_tableau");

/*Fabrique un noeud TD et l'ajoute au bout d'un noeud (en principe) TR passé en paramètre*/
function ajouterTDaTR(noeudTR,texte){
	noeudTD = document.createElement("td");
	noeudTD.innerHTML = texte;
	noeudTR.appendChild(noeudTD);
}


/*Fabrique un noeud TD invisible et l'ajoute au noeud TR passé en paramètre*/
function ajouterTDaTRinvisible(noeudTR,valeur){
	noeudTD = document.createElement("td");
	noeudTD.style = "display:none";
	noeudTD.innerHTML = valeur;
	noeudTR.appendChild(noeudTD);
}

/*Retourne l'identifiant d'un noeud TR (nécessaire afin de réordonner les noeuds correctement*/
var longueurTR=0;
function identifiantTR(noeudTR,longueurTR){
	
	return +(noeudTR.children[longueurTR-1].innerHTML)-1;	
	//Ne pas mettre ".children[0]" juste après "noeudTR.children[longueurTR-1]"
}


/*Fonction de tri des noeuds selon id*/
function triSelonId(longueur){ return (function(a,b){
				if (identifiantTR(a,longueur)>identifiantTR(b,longueur))
					return 1;
				if (identifiantTR(a,longueur)<identifiantTR(b,longueur))
					return -1;
				return 0;
})};

var tableau_js = [];
var colonne_tableau_js;
/*Affecte les données au petit tableau*/

function affichage_petit_tableau(mode,jour_min,jour_max){
	
	console.log(jour_min,jour_max);

	
	var noeudTDfin, noeudTR;
	
	noeudTR = document.createElement("tr");
	petit_tableau.innerHTML = '';
	
	
	//Affecter les valeurs par numéro d'équipe
	if(mode == 0 || mode == 1 || mode == 2){
		var prendre_domicile = (mode != 2);
		var prendre_exterieur = (mode != 1);
		
		
		ajouterTDaTR(noeudTR,"Club");
		ajouterTDaTR(noeudTR,"J");
		ajouterTDaTR(noeudTR,"Points");
		ajouterTDaTR(noeudTR,"G");
		ajouterTDaTR(noeudTR,"N");
		ajouterTDaTR(noeudTR,"P");
		ajouterTDaTR(noeudTR,"BP");
		ajouterTDaTR(noeudTR,"BC");
		ajouterTDaTR(noeudTR,"DdB");
		ajouterTDaTR(noeudTR,"IdD");
		ajouterTDaTRinvisible(noeudTR,-1);
		petit_tableau.appendChild(noeudTR);
		longueurTR = noeudTR.children.length;
		
		for(num=0;num<=nb_equipes-1;num++){
			total_bp = 0;
			total_bc = 0;
			total_g = 0;
			total_n = 0;
			total_p = 0;
			total_idd = 0;
			//console.log("Equipe "+num+" joue dom "+tableau_joue_dom[num]);
			for(jour=jour_min;jour<=jour_max;jour++){
				if( ((mode != 2)  && (tableau_joue_dom[num][jour] == 1))
				||  ((mode != 1) && (tableau_joue_dom[num][jour] == 0))){
					if (+tableau_pts[num][jour] == 3){
						total_g++;
					}
					if (+tableau_pts[num][jour] == 0){
						total_p++;
					}
					if(+tableau_pts[num][jour] == 1){
						total_n++;
					}
					total_bp += +tableau_bp[num][jour];
					total_bc += +tableau_bc[num][jour];
					total_idd += +tableau_idd[num][jour];
				}
			}
			noeudTR = document.createElement("tr");
			
			ajouterTDaTR(noeudTR,tableau_dim_noms[num+1]); //Pourquoi "+1" ?
			ajouterTDaTR(noeudTR,total_g+total_n+total_p);
			ajouterTDaTR(noeudTR,total_g*3+total_n);
			ajouterTDaTR(noeudTR,total_g);
			ajouterTDaTR(noeudTR,total_n);
			ajouterTDaTR(noeudTR,total_p);
			ajouterTDaTR(noeudTR,total_bp);
			ajouterTDaTR(noeudTR,total_bc);
			ajouterTDaTR(noeudTR,total_bp-total_bc);
			ajouterTDaTR(noeudTR,total_idd);
			ajouterTDaTRinvisible(noeudTR,num);
			petit_tableau.appendChild(noeudTR);
			
			
		}
	}
	
	//IDD
	if (mode == 3){
		noeudTR = document.createElement("tr");
		ajouterTDaTR(noeudTR,"Club");
		ajouterTDaTR(noeudTR,"Total");
		ajouterTDaTR(noeudTR,"Positif");
		ajouterTDaTR(noeudTR,"Négatif");
		ajouterTDaTR(noeudTR,"Victoires avec <0");
		ajouterTDaTR(noeudTR,"Nuls avec <0");
		ajouterTDaTR(noeudTR,"Défaites avec >0");
		ajouterTDaTR(noeudTR,"Nuls avec >0");
		ajouterTDaTR(noeudTR,"Max");
		ajouterTDaTR(noeudTR,"Jour");
		ajouterTDaTR(noeudTR,"Adv.");
		ajouterTDaTR(noeudTR,"Min");
		ajouterTDaTR(noeudTR,"Jour"); 
		ajouterTDaTR(noeudTR,"Adv."); 
		ajouterTDaTRinvisible(noeudTR,-1);
		petit_tableau.appendChild(noeudTR);
		
		
		var idd = 0;
		for(num=0;num<=nb_equipes-1;num++){
			total_idd = 0;
			nb_idd_p = 0;
			nb_idd_n = 0;
			nb_d_idd_p = 0;
			nb_n_idd_p = 0;
			nb_v_idd_n = 0;
			nb_n_idd_n = 0;
			max_idd = tableau_idd[num][jour_min];
			min_idd = tableau_idd[num][jour_min];
			jour_max_idd = jour_min;
			jour_min_idd = jour_min;
			for(jour=jour_min;jour<=jour_max;jour++){
				idd = +tableau_idd[num][jour];
				total_idd += idd;
				if(idd > max_idd){
					max_idd = idd;
					jour_max_idd = jour;
				}
				if(idd < min_idd){
					min_idd = idd;
					jour_min_idd = jour;
				}
				if(idd > 0){
					nb_idd_p++;
					if(+tableau_pts[num][jour] == 1){
						nb_n_idd_p++;
					}
					if(+tableau_pts[num][jour] == 0){
						nb_d_idd_p++;
						//console.log('Exemple défaite idd positive : '+tableau_dim_noms[num+1]+'-J+'+jour+' '+idd);
					}
				}
				if(idd < 0){
					nb_idd_n++;
					if(+tableau_pts[num][jour] == 1){
						nb_n_idd_n++;
					}
					if(+tableau_pts[num][jour] == 3){
						nb_v_idd_n++;
						//console.log('Exemple victoire idd négative : '+tableau_dim_noms[num+1]+'-J+'+jour+' '+idd);
					}
				}			
			}
			
			noeudTR = document.createElement("tr");
			ajouterTDaTR(noeudTR,tableau_dim_noms[num+1]);
			ajouterTDaTR(noeudTR,total_idd);
			ajouterTDaTR(noeudTR,nb_idd_p);
			ajouterTDaTR(noeudTR,nb_idd_n);
			ajouterTDaTR(noeudTR,nb_v_idd_n);
			ajouterTDaTR(noeudTR,nb_n_idd_n);
			ajouterTDaTR(noeudTR,nb_d_idd_p);
			ajouterTDaTR(noeudTR,nb_n_idd_p);
			ajouterTDaTR(noeudTR,max_idd);
			ajouterTDaTR(noeudTR,'J'+jour_max_idd);
			ajouterTDaTR(noeudTR,tableau_dim_noms[tableau_adv[num][+jour_max_idd]]);
			ajouterTDaTR(noeudTR,min_idd);
			ajouterTDaTR(noeudTR,'J'+jour_min_idd); /*Ajouter les adversaires (honnêtement j'ai la flemme ce soir*/
			ajouterTDaTR(noeudTR,tableau_dim_noms[tableau_adv[num][+jour_min_idd]]); /*Ajouter les adversaires (honnêtement j'ai la flemme ce soir*/
			ajouterTDaTRinvisible(noeudTR,num); //Copié-collé des noms de colonnes, j'avais tout changé sauf le "-1" ci-dessus 
			petit_tableau.appendChild(noeudTR);
		}
		
	}
	
	//Buts par période
	if (mode == 4){
		var bps;
		var bcs;
		var total = [0,0,0,0,0,0,0];
		
		noeudTR = document.createElement("tr");
		ajouterTDaTR(noeudTR,"Club");
		ajouterTDaTR(noeudTR,"1-15");
		ajouterTDaTR(noeudTR,"16-30");
		ajouterTDaTR(noeudTR,"31-45");
		ajouterTDaTR(noeudTR,"46-60");
		ajouterTDaTR(noeudTR,"61-75");
		ajouterTDaTR(noeudTR,"76-89");
		ajouterTDaTR(noeudTR,"90");		
		ajouterTDaTR(noeudTR,"1-15");
		ajouterTDaTR(noeudTR,"16-30");
		ajouterTDaTR(noeudTR,"31-45");
		ajouterTDaTR(noeudTR,"46-60");
		ajouterTDaTR(noeudTR,"61-75");
		ajouterTDaTR(noeudTR,"76-89");
		ajouterTDaTR(noeudTR,"90");
		ajouterTDaTRinvisible(noeudTR,-1);
		petit_tableau.appendChild(noeudTR);
		for(num=0;num<=nb_equipes-1;num++){
			bps = [0,0,0,0,0,0,0];
		    bcs = [0,0,0,0,0,0,0];
			
			
			for(jour=jour_min;jour<=jour_max;jour++){
				bps[0]+= +tableau_bp_1_15[num][jour];
				bps[1]+= +tableau_bp_16_30[num][jour];
				bps[2]+= +tableau_bp_31_45[num][jour];
				bps[3]+= +tableau_bp_46_60[num][jour];
				bps[4]+= +tableau_bp_61_75[num][jour];
				bps[5]+= +tableau_bp_76_89[num][jour];
				bps[6]+= +tableau_bp_90[num][jour];						
				total[0]+= +tableau_bp_1_15[num][jour];
				total[1]+= +tableau_bp_16_30[num][jour];
				total[2]+= +tableau_bp_31_45[num][jour];
				total[3]+= +tableau_bp_46_60[num][jour];
				total[4]+= +tableau_bp_61_75[num][jour];
				total[5]+= +tableau_bp_76_89[num][jour];
				total[6]+= +tableau_bp_90[num][jour];				
				bcs[0]+= +tableau_bc_1_15[num][jour];
				bcs[1]+= +tableau_bc_16_30[num][jour];
				bcs[2]+= +tableau_bc_31_45[num][jour];
				bcs[3]+= +tableau_bc_46_60[num][jour];
				bcs[4]+= +tableau_bc_61_75[num][jour];
				bcs[5]+= +tableau_bc_76_89[num][jour];
				bcs[6]+= +tableau_bc_90[num][jour];
			}
			noeudTR = document.createElement("tr");
			ajouterTDaTR(noeudTR,tableau_dim_noms[num+1]);
			ajouterTDaTR(noeudTR,bps[0]);
			ajouterTDaTR(noeudTR,bps[1]);
			ajouterTDaTR(noeudTR,bps[2]);
			ajouterTDaTR(noeudTR,bps[3]);
			ajouterTDaTR(noeudTR,bps[4]);
			ajouterTDaTR(noeudTR,bps[5]);
			ajouterTDaTR(noeudTR,bps[6]);			
			ajouterTDaTR(noeudTR,bcs[0]);
			ajouterTDaTR(noeudTR,bcs[1]);
			ajouterTDaTR(noeudTR,bcs[2]);
			ajouterTDaTR(noeudTR,bcs[3]);
			ajouterTDaTR(noeudTR,bcs[4]);
			ajouterTDaTR(noeudTR,bcs[5]);
			ajouterTDaTR(noeudTR,bcs[6]);
			ajouterTDaTRinvisible(noeudTR,num); 
			petit_tableau.appendChild(noeudTR);
		}
		noeudTR = document.createElement("tr");
		ajouterTDaTR(noeudTR,"Total");
		ajouterTDaTR(noeudTR,total[0]);
		ajouterTDaTR(noeudTR,total[1]);
		ajouterTDaTR(noeudTR,total[2]);
		ajouterTDaTR(noeudTR,total[3]);
		ajouterTDaTR(noeudTR,total[4]);
		ajouterTDaTR(noeudTR,total[5]);
		ajouterTDaTR(noeudTR,total[6]);			
		ajouterTDaTR(noeudTR,total[0]);
		ajouterTDaTR(noeudTR,total[1]);
		ajouterTDaTR(noeudTR,total[2]);
		ajouterTDaTR(noeudTR,total[3]);
		ajouterTDaTR(noeudTR,total[4]);
		ajouterTDaTR(noeudTR,total[5]);
		ajouterTDaTR(noeudTR,total[6]);	
		ajouterTDaTRinvisible(noeudTR,21); 
		petit_tableau.appendChild(noeudTR);
	}
	
	
	//Remontées par période
	if (mode == 5){
		noeudTR = document.createElement("tr");
		ajouterTDaTR(noeudTR,"Club");
		ajouterTDaTR(noeudTR,"Pts gagnés 2nde MT");
		ajouterTDaTR(noeudTR,"Pts perdus 2nde MT");
		ajouterTDaTR(noeudTR,"Pts gagnés après 60'");
		ajouterTDaTR(noeudTR,"Pts perdus après 60'");
		ajouterTDaTR(noeudTR,"Pts gagnés après 75'");
		ajouterTDaTR(noeudTR,"Pts perdus après 75'");
		ajouterTDaTR(noeudTR,"Pts gagnés à 90'");
		ajouterTDaTR(noeudTR,"Pts perdus à 90'");
		ajouterTDaTRinvisible(noeudTR,-1);
		petit_tableau.appendChild(noeudTR);
		
		
		var gains = []; //Gains de points à partir de 45', 610' 75' 90' pour chaque équipe (double entrée)
		var pertes = [];
		var score; //buts marqués après 45', 60', 75', 90' par l'équipe désignée par num
		var scoreAdv;
		var points; //points -3,1,0- à l'issue de 45', 60', 75', 90' pour l'équipe désignée par num
		var pointsAdv; //0,1,3
		var pointsFinal;
		var pointsFinalAdv;
		for(num=0;num<=nb_equipes-1;num++){
			gains.push([0,0,0,0]);
			pertes.push([0,0,0,0]);
		}
		
		for(num=0;num<=nb_equipes-1;num++){
			for(jour=jour_min;jour<=jour_max;jour++){
				var numAdversaire = tableau_adv[num][jour]-1; //le -1 garantit que les numéros des équipes aillent de 0 à nb_equipes.
				if (numAdversaire > num){
					pointsFinal = tableau_pts[num][jour];
					pointsFinalAdv = tableau_pts[numAdversaire][jour];

					for(var etape=0;etape<=3;etape++){
						switch(etape){
							case 0:
								score = +tableau_bp_1_15[num][jour]+ +tableau_bp_16_30[num][jour]+ +tableau_bp_31_45[num][jour];
								scoreAdv = +tableau_bp_1_15[numAdversaire][jour]+ +tableau_bp_16_30[numAdversaire][jour]+ +tableau_bp_31_45[numAdversaire][jour];
							break;
							case 1:
								score+= +tableau_bp_46_60[num][jour];
								scoreAdv+= +tableau_bp_46_60[numAdversaire][jour];
							break;
							case 2:
								score+= +tableau_bp_61_75[num][jour];
								scoreAdv+= +tableau_bp_61_75[numAdversaire][jour];
							break;
							case 3:
								score+= +tableau_bp_76_89[num][jour];
								scoreAdv+= +tableau_bp_76_89[numAdversaire][jour];
							break;
							default:
							break;
						}
						if (score == scoreAdv){
							points =1;
							pointsAdv = 1;
						}
						else if (score < scoreAdv){
							points =0;
							pointsAdv = 3;
						}
						else{
							points =3;
							pointsAdv = 0;
						}
						//console.log("(J"+jour+") 45 minutes. Equipes "+num+" "+numAdversaire+" : "+points+" "+pointsAdv+" S "+score+" "+scoreAdv);
						pertes[num][etape] += (points > pointsFinal ? points-pointsFinal:0);
						pertes[numAdversaire][etape] += (pointsAdv > pointsFinalAdv ? pointsAdv-pointsFinalAdv:0);
						gains[num][etape] += (points < pointsFinal ? pointsFinal-points:0);
						gains[numAdversaire][etape] += (pointsAdv < pointsFinalAdv ? pointsFinalAdv-pointsAdv:0);
					}
				}
			}
		}
		for(num=0;num<=nb_equipes-1;num++){
			noeudTR = document.createElement("tr");
			ajouterTDaTR(noeudTR,tableau_dim_noms[num+1]);
			ajouterTDaTR(noeudTR,gains[num][0]);
			ajouterTDaTR(noeudTR,pertes[num][0]);
			ajouterTDaTR(noeudTR,gains[num][1]);
			ajouterTDaTR(noeudTR,pertes[num][1]);			
			ajouterTDaTR(noeudTR,gains[num][2]);
			ajouterTDaTR(noeudTR,pertes[num][2]);			
			ajouterTDaTR(noeudTR,gains[num][3]);
			ajouterTDaTR(noeudTR,pertes[num][3]);
			ajouterTDaTRinvisible(noeudTR,num); 
			petit_tableau.appendChild(noeudTR);
		}
		
	}
	
	

	
	
	//Récupérer ces données pour les tableaux à venir
	tableau_js = recuperation_donnees_noeud_tableau(petit_tableau,1,0);
	
	longueurTR = noeudTR.children.length;
	//Cela nécessite également de changer les actionListener, je m'en suis rendu compte au bout d'un moment en ne constatant que le log sur "colonne_tableau_js" n'était vu qu'une fois
	for(index=0;index<longueurTR;index++){ //Et pas "children[0].length" comme je le pensais !
		colonne_tableau_js = [];
		for(num=0;num<nb_equipes;num++){
			colonne_tableau_js.push(tableau_js[num][index]);	
		}
		petit_tableau.children[0].children[index].addEventListener('click',
			ordonnerTDselonIndiceEtTableau(0,index,petit_tableau,colonne_tableau_js,triSelonId(longueurTR)) //ici, petit_tableau.children[0] est en fait un <tbody></tbody>. Il s'est intercalé après la table. Pourquoi ? Mystère...
		);
	}
	
	
	/*console.log("Tableau adversaires");
	console.log(tableau_adv);
	console.log("Tableau dim noms");
	console.log(tableau_dim_noms);*/
}


petit_tableau.style.visibility = true;


	
//Tous les AEL sur les select sont ici !	
noeud_select_petit_tableau = document.getElementById("select_petit_tableau");
noeud_select_petit_tableau.addEventListener('change',function(e){
	affichage_petit_tableau(noeud_select_petit_tableau.selectedIndex,journeeDebut,journeeDebut);
});



var selectJourneeDebut = document.getElementById("select_journee_debut");
var selectJourneeFin = document.getElementById("select_journee_fin");
var journeeDebut = 1;
var journeeFin = 38;
affichage_petit_tableau(noeud_select_petit_tableau.selectedIndex,journeeDebut,journeeFin);

selectJourneeDebut.addEventListener("change",function(e){
	if (+selectJourneeDebut.value <= +selectJourneeFin.value){
		journeeDebut = +selectJourneeDebut.value;
		journeeFin = +selectJourneeFin.value;
		affichage_petit_tableau(noeud_select_petit_tableau.selectedIndex,journeeDebut,journeeFin);
	}
});

selectJourneeFin.addEventListener("change",function(e){
	if (+selectJourneeDebut.value <= +selectJourneeFin.value){
		journeeDebut = +selectJourneeDebut.value;
		journeeFin = +selectJourneeFin.value;
		affichage_petit_tableau(noeud_select_petit_tableau.selectedIndex,journeeDebut,journeeFin);
	}
});

</script>