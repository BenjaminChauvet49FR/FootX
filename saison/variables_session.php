<?php
if(isset($_GET['select_saison'])){
	$_SESSION['saison'] = $_GET['select_saison']; //Le nom "select_saison" est impératif. cf. combobox_saisons.php
}
if(!isset($_SESSION['saison'])){
	$_SESSION['saison'] = 1;
}
?>