<?php session_start();
	include 'dane.php';
	
	$connectorg= new mysqli(HOST,USERORG,PASSORG,DBORG);
	$connectorg->query('SET NAMES utf8');
	
	$znajdz=$_POST['znajdz'];
	$result=$connectorg->query("SELECT id FROM tematy WHERE name LIKE '$znajdz'");
	$id=$result->fetch_assoc()['id'];
	header("Location:index.php?strona=temat&temat=$id");
?>