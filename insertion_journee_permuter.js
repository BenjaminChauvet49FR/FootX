/*Gère les permutations des équipes*/

var iSauve = -1;
var chaineSauve = "";
var blocsEquipes = document.getElementsByClassName("span_equipe");
var blocsInputsCaches = document.getElementsByClassName("input_cache_span_equipe");
var blocsEquipesDejaEntres = document.getElementsByClassName("span_equipeDejaEntre");
var blocsInputsCachesDejaEntres = document.getElementsByClassName("input_cache_span_equipeDejaEntre");


/*Closure sur le clic de sélection d'un élément susceptible d'être permuté
Important : seuls les innerHTML et les value des inputs cachés sont permutés ; 
pas les numéros des blocs ni les noms des inputs cachés. */
function closure_selection_permuter(i){
	return(
		function(){
			var fait = false;
			if (iSauve != -1){
				console.log("Cliqué sur le 2nd bloc "+i);
				blocsInputsCaches[iSauve].value = blocsEquipes[iSauve].innerHTML = blocsEquipes[i].innerHTML;
				blocsInputsCaches[i].value = blocsEquipes[i].innerHTML = chaineSauve;
				
				//Nettoyage
				blocsEquipes[i].style.backgroundColor = "white";
				blocsEquipes[iSauve].style.backgroundColor = "white";
				chaineSauve = "";
				iSauve = -1;
				fait = true;
			}
			if (!fait){
				console.log("Cliqué sur le 1er bloc "+i);
				iSauve = i;
				chaineSauve = blocsEquipes[i].innerHTML;
				blocsEquipes[i].style.backgroundColor = "cyan";
			}		
		}					
	)
}


/*Ajout des event listeners*/
for(var i=0;i<blocsEquipes.length;i++)
	blocsEquipes[i].addEventListener('click',closure_selection_permuter(i));