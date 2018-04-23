        <?php
				
			//Variables de session et page
			if(isset($_GET['select_journee'])){ 
				$_SESSION['journee'] = $_GET['select_journee'];
			}
			if(!isset($_SESSION['journee'])){
				$_SESSION['journee'] = 1;
			}

			$CT_NB_EQUIPES = 20;			
			$CT_NB_RENCONTRES = $CT_NB_EQUIPES/2;
			
			$requetes ='';
			include('debug/requete_sql.php');
			function ajouter_echo_requetes($commentaire,$requete){
				echo_sql($requete);//11 80 84p 90 ;30 48 
			}
			
			//Insertion d'un match avec date, heure, journée, noms des équipes (2), buts des équipes 
			function inserer_match($date,$heure,$journee,$saison,$nom_dim_dom,$nom_dim_ext,$chaineButs,$bdd){
				$query_equipeDom = $bdd->query('SELECT * from v_equipe_saison where id_saison='.$saison.' and dim_nom like \''.$nom_dim_dom.'\'');
				$query_equipeExt = $bdd->query('SELECT * from v_equipe_saison where id_saison='.$saison.' and dim_nom like \''.$nom_dim_ext.'\'');
				$equipeDom = $query_equipeDom->fetch();					
				$equipeExt = $query_equipeExt->fetch();
				$num_eqDom = $equipeDom['numero'];
				$num_eqExt = $equipeExt['numero'];
				$dateSplit = explode("/",$date);
				$date2= $dateSplit[2].'-'.$dateSplit[1].'-'.$dateSplit[0];
				$dateComplete = $date2.' '.$heure;
				$requete = 'INSERT INTO matchs (journee,id_saison,date,num_eq_dom,num_eq_ext) 
								  VALUES('.$journee.','.$saison.',\''.$dateComplete.'\','.$num_eqDom.',
								  '.$num_eqExt.')';				  
								  
				ajouter_echo_requetes('Requête d\'insertion de match (nouveau) : ',$requete);
				$bdd->query($requete);		


				$bdd->query('DELETE from but 
				where journee='.$_SESSION['journee'].' and
        id_saison ='.$_SESSION['saison'].' and 
				num_equipe in ('.$num_eqDom.','.$num_eqExt.')');
				
				//Réinsertion
				$equipes = explode(";",$chaineButs);
				$buts = explode(" ",$equipes[0]);
				for($ib=0;$ib<sizeof($buts);$ib++)
					inserer_but($num_eqDom,$buts[$ib],$bdd);
				$buts = explode(" ",$equipes[1]);
				for($ib=0;$ib<sizeof($buts);$ib++)
					inserer_but($num_eqExt,$buts[$ib],$bdd);

				
			}
			
			
			
			function numeroTypeDeBut($minuteBut){
				switch(substr($minuteBut,-1,1)){
					case 'p': $reponse = 1;break;
					case 'c': $reponse = 2;break;
					default : $reponse = 0;break;
				}
				return $reponse;
			}
			
			function lettreTypeDeBut($typeBut){
				switch($typeBut){
					case 1: $reponse = 'p';break;
					case 2: $reponse = 'c';break;
					default : $reponse = '';break;
				}
				return $reponse;
			}
			
			function minuteMatch($minuteBut){
				$p = strrpos($minuteBut,"+");
				if (!($p === false)){
					return substr($minuteBut,0,$p); //substr : index premier caractère (à partir de 0), longueur maximale de la chaîne retournée quand positif
				}
				$c = substr($minuteBut,-1,1);
				//if ($c == 'p' || $c == 'c')
				if (numeroTypeDeBut($minuteBut) != 0)
					return substr($minuteBut,0,-1); //-1 : tous les caractères sauf le dernier
				return $minuteBut;
			}
			
			function minutesAdditionelles($minuteBut){
				$p = strrpos($minuteBut,"+");
				if (!($p === false)){
					if (numeroTypeDeBut($minuteBut) != 0)
						return substr($minuteBut,$p+1,-1);//A partir de la position p+1 (p = celle du plus) sauf le dernier caractère
					else
						return substr($minuteBut,$p+1); //A partir de la position p+1 (celle du plus)
				}
				return '';
			}
			
			//Insère un match en donnant l'id de l'équipe et la minute.
			//La journée est déjà contenue en variable de session
			//minute peut finir 'p' ou 'c' pour 'pénalty' ou 'csc'
			function inserer_but($num_equipe,$minute,$bdd){
				/*$requete = 'INSERT INTO `but` (journee,id_saison ,`num_equipe`, `minute`, `special`) 
				VALUES ('.$_SESSION['journee'].','.$_SESSION['saison'].', '.$num_equipe.', '.minuteMatch($minute).', '
				.numeroTypeDeBut($minute).')' ;*/
				$requete = 'INSERT INTO `but` (journee,id_saison ,`num_equipe`, `minute`) 
				VALUES ('.$_SESSION['journee'].','.$_SESSION['saison'].', '.$num_equipe.', '.minuteMatch($minute).')' ;
				$bdd->query($requete);
				ajouter_echo_requetes('Requête d\'insertion de but : ',$requete);
				$numero = numeroTypeDeBut($minute);
				$lastID = $bdd->lastInsertId();
				if ($numero != 0){
					$requete = 'INSERT INTO `but_special` (id_but,special) VALUES ('.$lastID.','.$numero.')';
					$bdd->query($requete);
					ajouter_echo_requetes('Requête d\'insertion de but spécial : ',$requete);
				}
				$minutes = minutesAdditionelles($minute);
				if ($minutes != 0){
					$requete = 'INSERT INTO `but_temps_additionnel` (id_but,minute_plus) VALUES ('.$lastID.','.$minutes.')';
					$bdd->query($requete);
					ajouter_echo_requetes('Requête d\'insertion de but de temps additionnel : ',$requete);
				}
				
			}
			
			// ----------------------------------------
			// Insertion des matches
			for($ir=0;$ir<$CT_NB_RENCONTRES;$ir++){
				if(isset($_POST['checkbox_nouveauMatch'.$ir])){
					inserer_match($_POST['date'.$ir],
								$_POST['heure'.$ir],
								$_SESSION['journee'],
								$_SESSION['saison'],
								$_POST['ed'.$ir],
								$_POST['eex'.$ir],
								$_POST['input_butsNouveauMatch'.$ir],
								$bdd);	
				}
			}

			// ----------------------------------------			
			// Insertion/suppression des matches 
			// d'abord supprimer les buts
			for($ir=0;$ir<$CT_NB_RENCONTRES;$ir++){
				if(isset($_POST['checkbox_matchDejaEntre'.$ir])){
						//Suppression des buts
						$num_eqDom = $_POST['input_cache_matchDejaEntreDom'.$ir];
						$num_eqExt = $_POST['input_cache_matchDejaEntreExt'.$ir];
						$requete = 'DELETE from but 
						where id_saison='.$_SESSION['saison'].' 
						and journee='.$_SESSION['journee'].' and 
						num_equipe in ('.$num_eqDom.','.$num_eqExt.')';
						$bdd->query($requete);
						ajouter_echo_requetes('Requête de suppression de but : ',$requete);
						
						if(!($_POST['action'] == 'Suppression')){       //1910545 Le jour où le bouton ne s'appellera plus 'Suppression'...
							//echo('<script>alert(\'EDITION !\')</script>');
							//Réinsertion des buts (sauf si suppression)
							$equipes = explode(';',$_POST['input_matchDejaEntre'.$ir]);
							$buts = explode(" ",$equipes[0]);
							$scoreD = sizeof($buts);
							for($ib=0;$ib<sizeof($buts);$ib++)
								inserer_but($num_eqDom,$buts[$ib],$bdd);
							$buts = explode(" ",$equipes[1]);
							$scoreE = sizeof($buts);
							for($ib=0;$ib<sizeof($buts);$ib++)
								inserer_but($num_eqExt,$buts[$ib],$bdd);
							
						} else{
						  //Suppression du match
						  $requete = 'delete from matchs where id_saison = '.$_SESSION['saison'].' and journee='.
						  $_SESSION['journee'].' and num_eq_dom = '.$num_eqDom;
						  $bdd->query($requete);
							ajouter_echo_requetes('Requête de suppression de match : ',$requete);
						}  
				}	
			}
			
			// ----------------------------------------
			// Echo des requêtes d'insert/update/delete
			echo($requetes);
			
			
			
		?>