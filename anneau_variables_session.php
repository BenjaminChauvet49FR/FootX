<?php			
/*Variables de session 1910545 Ce code dupliqué est moche*/
if(isset($_GET['select_journeeA'])){
	$_SESSION['journeeA'] = $_GET['select_journeeA'];
}
if(!isset($_SESSION['journeeA'])){
	$_SESSION['journeeA'] = 1;
}
if(isset($_GET['select_journeeB'])){
	$_SESSION['journeeB'] = $_GET['select_journeeB'];
}
if(!isset($_SESSION['journeeB'])){
	$_SESSION['journeeB'] = 2;
}
include('transverse/variables_session_saison.php');
?>