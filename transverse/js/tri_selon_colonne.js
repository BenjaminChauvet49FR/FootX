var indiceTotal = 0;
var idTotal = -1;
var sens = 1;

/*
Effectue le tri sur un tableau de noeuds selon une colonne
id : id du tableau (en relation avec "idTotal", une variable externe). Permet de trier dans un sens ou dans le sens inverse si on reclique.
indiceCol : indice de la colonne au sein du tableau. Accompagne id.
noeudTableau : noeud qui contient des enfants de type tr
colonne : colonne (de noeudTableau) selon laquelle les enfants de noeudTableau sont triés. 
fonctionTriNaturel : fonction selon laquelle les enfants de noeudTableau sont naturellement triés (ie sans cliquer sur une colonne.)
*/
function ordonnerTDselonIndiceEtTableau(id,indiceCol,noeudHTMLTableau,colonne,fonctionTriNaturel) {
	return(	
		function(){			
		
			//Définition du sens et affectation des variables "totales".
			sens = (((indiceTotal == indiceCol) && (id == idTotal)) ? -sens : 1);
			indiceTotal = indiceCol;
			idTotal = id;

			//Tri de la colonne "colonne" 
			var listeTri = new Array(nb_equipes);
			for(j=0;j<nb_equipes;j++){
				listeTri[j] = {cle:j,valeur:colonne[j]}
			}
			listeTri.sort(function(a,b){
				return(( (+a.valeur)-(+b.valeur))*sens);
			});	
			
			//Tri des noeuds dans l'ordre "naturel" des id. 
			var noeudsTR = [];
			for(j=0;j<nb_equipes;j++)
				noeudsTR.push(noeudHTMLTableau.children[j+1]);
			noeudsTR.sort(fonctionTriNaturel);
			
			//Chamboulement du tri naturel au moyen de listeTri.
			for(num=0;num<nb_equipes;num++){
				noeudHTMLTableau.appendChild(noeudsTR[listeTri[num].cle]); //Chaque noeud est un objet. L'append, c'est le déplacer.
			}
		}
	);
	
}
