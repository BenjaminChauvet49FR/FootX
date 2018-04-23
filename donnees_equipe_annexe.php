<?php
//Variables de session et page
if(isset($_POST['select_club'])){
	$_SESSION['num_club'] = $_POST['select_club'];
}
if(!isset($_POST['num_club'])){
	$_SESSION['num_club'] = 1;
}
?>