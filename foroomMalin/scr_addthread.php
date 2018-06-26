<?php
include 'dane.php';
session_start();
if((!isset($_POST['name']))||(!isset($_POST['tresc']))){
	$_SESSION['er_addthread']="Nazwa tematu i jego treść nie mogą być puste";
	header("Location:index.php?strona=addthread");
	exit();
}
$name=$_POST['name'];
$tresc=$_POST['tresc'];
if((strlen($name)<3)||(strlen($tresc)<20)){
	$_SESSION['er_addthread']="Nazwa musi zawierać co najmniej trzy znaki, zaś treść dwadzieścia";
	header("Location:index.php?strona=addthread");
	exit();
	
}

$name=htmlentities($name,ENT_QUOTES,"UTF-8");
$tresc=nl2br($tresc);
//$tresc=htmlentities($tresc,ENT_QUOTES,"UTF-8");


$connectorg= new mysqli(HOST,USERORG,PASSORG,DBORG);
$connectorg->query('SET NAMES utf8');
	if($connectorg->query("
	INSERT INTO tematy VALUES (NULL,'$name',".$_SESSION['id']."
	,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,".$_SESSION['kategoria'].")"))
	{
		$id=$connectorg->insert_id;
		$connectposty= new mysqli(HOST,USERPOSTY,PASSPOSTY,DBPOSTY);
		$connectposty->query('SET NAMES utf8');
		
		$connectposty->query("INSERT INTO posty VALUES (NULL,'$tresc',
	".$_SESSION['id'].",'$id',CURRENT_TIMESTAMP)");
		
		$_SESSION['komunikat']="Udało się dodać temat!";
	}
	else {
		$connectorg->close();
		$_SESSION['er_addthread']="Coś się nie powiodło";
		header("Location:index.php?strona=addthread");
		exit();
	}
	$connectorg->close();
	$connectposty->close();
header("Location:index.php?strona=temat&temat=$id");
?>