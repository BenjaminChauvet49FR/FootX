<?php 
function tableau_vers_chaine($tableau){
	$reponse = '';
	foreach($tableau as $element){
		$reponse = $reponse.' '.$element;		
	}
	return $reponse;
}
?>

<script>
	/*chaine_tableau : une variable php (obtenue via echo) qui correspond à un tableau*/
	function chaine_vers_tableau(chaine_tableau){
		return chaine_tableau.split(" ");
	}
	
	
</script>

<!--Exemple de subterfuge pour utiliser du code JS avec des données de PHP-->
<!------Ce qui suit est un test à ignorer !------>