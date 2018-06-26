<?php  session_start();	include "dane.php";	
	
	if(isset($_POST['parent'])){
		
	$parent=$_POST['parent'];
	$nazwakat=$_POST['nazwakat'];
	$opiskat=$_POST['opiskat'];
	$connectorg= new mysqli(HOST,USERORG,PASSORG,DBORG);
	$connectorg->query('SET NAMES utf8');
	$result=$connectorg->query("
	SELECT MAX(kolej) AS m FROM kategorie WHERE parent='$parent'
	");
	$row=$result->fetch_assoc();
	$kolej=intval($row['m'])+1;
	$connectorg->query("INSERT INTO kategorie VALUES (NULL,'$nazwakat','$opiskat','".$_POST['parent']."','$kolej')");
	header("Location:admin_panel.php");
	}
	else if(isset($_POST['usun'])){
			
		
		$connectorg= new mysqli(HOST,USERORG,PASSORG,DBORG);
		$connectorg->query('SET NAMES utf8');
		$id=$_POST['usun'];
		$connectorg->query("DELETE FROM kategorie WHERE id=$id
		");
		
		header("Location:admin_panel.php");
	}
	else if(isset($_POST['edytuj'])){
	
	$nazwakat=$_POST['nazwakat'];
	$opiskat=$_POST['opiskat'];
	$id=$_POST['edytuj'];
	$connectorg= new mysqli(HOST,USERORG,PASSORG,DBORG);
	$connectorg->query('SET NAMES utf8');
	

	$connectorg->query("UPDATE kategorie SET name='$nazwakat', description='$opiskat' WHERE id='$id'");
	header("Location:admin_panel.php");
	}
    else if(isset($_POST['up'])){
       // echo $_POST['up'];
        $arr=explode(";",$_POST['up']);
        $first=$arr[0];
        $second=$arr[1];
        $defnot=9999999;
        print_r($arr);
        $connectorg=new mysqli(HOST,USERORG,PASSORG,DBORG);
        $result=$connectorg->query("SELECT kolej FROM kategorie WHERE id='$first'");
        $kolej1=$result->fetch_assoc()["kolej"];
        $result->free();
        $result=$connectorg->query("SELECT kolej FROM kategorie WHERE id='$second'");
        $kolej2=$result->fetch_assoc()["kolej"];
        $connectorg->query("UPDATE kategorie set kolej='$kolej1' WHERE id='$second'");
        $connectorg->query("UPDATE kategorie set kolej='$kolej2' WHERE id='$first'");
        $connectorg->close();
        $result->free();
        echo $kolej1;
        echo "<br>";
        echo $kolej2;
	header("Location:admin_panel.php");
    }

	else {
	header("Location:admin_panel.php");
		exit;
			
	}
	
	

?>