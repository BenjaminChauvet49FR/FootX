/*
Récupère les données contenus dans un tableau HTML.
noeudTableau : noeud délimité par les balises <table>
retraitLignes : nombre de lignes du tableau non recopiées (en partant de la gauche)
retraitColonnes : nombre de colonnes
*/
function recuperation_donnees_noeud_tableau(noeudTableau,retraitLignes,retraitColonnes){
	/*var reponse = [];
	//var noeud2 = noeudTableau.children[0]; //AVANT !
	console.log("Alola !");
	noeud2 = noeudTableau;
	console.log("Noeud 2");
	console.log(noeud2);
	var longueurLigne = noeud2.children[0].children.length;
	var ligne;
	//console.log("Dimensions du tableau = "+noeud2.children.length+" "+longueurLigne);
	for(iLigne=retraitLignes;iLigne<noeud2.children.length;iLigne++){
		ligne = [];
		for(iCol=retraitColonnes;iCol<longueurLigne;iCol++){
			ligne.push(noeud2.children[iLigne].children[iCol].innerHTML);
			//ligne.push(0);
		}
		reponse.push(ligne);
	}
	//console.log(reponse);
	return reponse;*/
	console.log("Salut !");
	return [];
	/*Bon à savoir :
	Avant on avait :
	petit_tableau.children[0] = <tbody>...</tbody> 
	petit_tableau.children[0].children[0] = <tr>...</tr>
	
	*/
	
}