<?php session_start();
	include "dane.php";		header("Location:admin_panel.php");
	if(!isset($_SESSION['staff'])){
		header("Location:index.php");
		exit();
	}
	if($_SESSION['staff']<100){
header("Location:index.php");
		exit();	
	}
	
	$connect = new mysqli(HOST,USERORG,PASSORG,DBORG);

	foreach($_POST as $key=>$i){
		if($key!=$_SESSION['id'])$connect->query("DELETE FROM users WHERE id='$key'");
		else $_SESSION['er_usun']="nie możesz usunąć siebie!";
	}
	$connect->close();
	
?>