<?php
	//Chaîne d'une saison lorsqu'on a déjà l'année de départ (obtenue par requête)
	function chaineSaison($annee){
		return $annee.'/'.(1+$annee);
	}
	
	//Chaîne d'une saison lorsqu'on n'a que l'ID (typiquement une variable de session)
	function chaineSaison_id($id,$bdd){
		$quete = $bdd->query('select annee_depart from saison where id = '.$id);
		$reponse = $quete->fetch();
		return $reponse['annee_depart'].'/'.(1+$reponse['annee_depart']);
	}
?>