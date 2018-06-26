<?php session_start();
include 'dane.php';

if(isset($_SESSION['temat_addpost'])){
	$id_temat=$_SESSION['temat_addpost'];
	unset($_SESSION['temat_addpost']);
}
if(!isset($_POST['tresc'])){
	$_SESSION['er_addpost']="Treść odpowiedzi nie może być pusta";
	header("Location:index.php?strona=temat&$temat=$id_temat");
	exit();
}

$tresc=$_POST['tresc'];
if(strlen($tresc)<10){
	$_SESSION['er_addpost']="Odpowiedź musi zawierać conajmniej 10 znaków";
	header("Location:index.php?strona=temat&temat=$id_temat");
	exit();
	
}
$tresc=htmlentities($_POST['tresc'],ENT_QUOTES,"UTF-8");
$tresc=nl2br($_POST['tresc']);
$connectposty=new mysqli(HOST,USERPOSTY,PASSPOSTY,DBPOSTY);
$connectposty->query('SET NAMES utf8');
	if($connectposty->query("INSERT INTO posty VALUES (NULL,'$tresc',".
	$_SESSION['id'].",'$id_temat',CURRENT_TIMESTAMP)"))
	{
		$connectorg=new mysqli(HOST,USERORG,PASSORG,DBORG);
		$connectorg->query("UPDATE tematy SET data_ost=CURRENT_TIMESTAMP WHERE id='$id_temat'");
		
		
		header("Location:index.php?strona=temat&temat=$id_temat");
		
		
		
		$_SESSION['komunikat']="Udało się dodać odpowiedź!";
	}

?>