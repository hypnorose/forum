<?php  session_start();	include "dane.php";	
	
	if(isset($_POST['edytuj'])){
	
	$parent=$_POST['parent'];
	$nazwakat=$_POST['nazwakat'];
	$opiskat=$_POST['opiskat'];
	$connectorg= new mysqli(HOST,USERORG,PASSORG,DBORG);
	$connectorg->query('SET NAMES utf8');
	$id=$_POST['edytuj'];

	$connectorg->query("UPDATE kategorie VALUES (NULL,'$nazwakat','$opiskat','".$_POST['parent']."','$row['id']')");
	header("Location:admin_panel.php");
	}


?>