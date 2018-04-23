/*Tableaux des schémas
Ce fichier gère les schémas d'écriture des rencontres, i.e. 
permet de spécifier une unique date et d'affecter aux 10 champs de date et heure les dates et les heures, au lieu de les affecter manuellement.
Il est toujours possible de modifier manuellement certaines heures et dates après. 
*/
var nomsSchemas = 
["Week-end classique",
 "Week-end vendredi x2",
 "Mardi x2 mercredi x8",
 "Mardi x3 mercredi x7",
 "Multiplexe général"]; //Cas d'un multiplexe général : spécifier heure et date

var joursPlus = 
[[0,1,1,1,1,1,1,2,2,2], 
 [0,0,1,1,1,1,1,2,2,2], 
 [0,0,1,1,1,1,1,1,1,1], 
 [0,0,0,1,1,1,1,1,1,1], 
]; 

var heures = 
[[20,17,20,20,20,20,20,15,17,21],
 [19,20,17,20,20,20,20,15,17,21],
 [19,21,19,19,19,19,19,19,19,21],
 [19,19,21,19,19,19,19,19,19,21],
];
var minutes = 
[[45,00,00,00,00,00,00,00,00,00],
 [00,45,00,00,00,00,00,00,00,00],
 [00,00,00,00,00,00,00,00,00,00],
 [00,00,00,00,00,00,00,00,00,00]
];

/*Utilitaire - date vers string YYYY/MM/DD puis réciproque*/
function date_to_string(value)
{
   return (value.getDate() <= 9 ? "0":"") + value.getDate() + "/" + (value.getMonth()<=8 ? "0":"") + (value.getMonth()+1) + "/" + value.getFullYear();
}

function string_to_date(dateStr) {
    var parts = dateStr.split("/");
    return new Date(parts[2], parts[1] - 1, parts[0]);
}

function heure_to_string(value)
{
   return value.getHours() + ":" + value.getMinutes() + (value.getMinutes() < 10 ? "0":"");
}


/*Script principal*/
//Fabrication du select
var noeud_select_schema = document.getElementById('select_schema');
noeud_select_schema.innerHTML = '';
var noeud_option;
for(var i=0;i<nomsSchemas.length;i++){
	noeud_option = document.createElement("option");
	noeud_option.setAttribute("value",nomsSchemas[i]);
	noeud_option.innerHTML=nomsSchemas[i];
	noeud_select_schema.appendChild(noeud_option);
}

//Blocage du champ d'heure si pas multiplexe général
noeud_select_schema.addEventListener('change',function(e){
	console.log('Changement, coucou ! '+noeud_select_schema.selectedIndex);
	if (noeud_select_schema.selectedIndex != nomsSchemas.length-1){
		document.getElementById('input_heureMultiplexeGeneralSchema').value='';
		document.getElementById('input_heureMultiplexeGeneralSchema').readOnly=true;
	}
	else{
		document.getElementById('input_heureMultiplexeGeneralSchema').readOnly=false;
		document.getElementById('input_heureMultiplexeGeneralSchema').value='20:00';		
	}
});

//Ajout de l'eventListener au clic du schéma
var span_clic_appliquerSchema = document.getElementById('span_clic_appliquerSchema');
span_clic_appliquerSchema.addEventListener('click',function(e){
	var dateDepart = new Date(string_to_date(document.getElementById('input_dateSchema').value));
	var dateHeureMatch = new Date(dateDepart);
	var blocsDates = document.getElementById('div_rencontres').getElementsByClassName('datepicker');	
	var blocsHeures = document.getElementById('div_rencontres').getElementsByClassName('heure');
	var is = noeud_select_schema.selectedIndex;
	if(is != nomsSchemas.length-1){
		for(var i=1;i<blocsDates.length;i++){ //1910545 Le "1" est dû au fait qu'on exclut le 1er datepicker qui définit les autres. A revoir, cette façon de sélectionner.
			dateHeureMatch.setDate(dateDepart.getDate()+joursPlus[is][i-1]);
			dateHeureMatch.setHours(heures[is][i-1]);
			dateHeureMatch.setMinutes(minutes[is][i-1]);
			blocsDates[i].value = date_to_string(dateHeureMatch);
			blocsHeures[i-1].value = heure_to_string(dateHeureMatch);
		}
	}
	else{
		var heureMultiplexe = document.getElementById('input_heureMultiplexeGeneralSchema').value;
		for(var i=1;i<blocsDates.length;i++){
			blocsDates[i].value = date_to_string(dateDepart);
			blocsHeures[i-1].value = heureMultiplexe;
		}
	}

});