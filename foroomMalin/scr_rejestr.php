<?php session_start();
include 'dane.php';
$login=$_POST['login'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$captcha=$_POST['captcha'];
$email=$_POST['email'];
$jakiemabyccaptcha=8;

if(isset($_POST['email']))
{
	$walidacja=true;
	if((strlen($login)<4) || (strlen($login)>20)) {
		$walidacja=false;
		$_SESSION['e_login']="Nick albo za krótki albo za długi nie wiem w sumie";
		
	}
	
	if(ctype_alnum($login)==false){
		$walidacja=false;
		$_SESSION['e_login']="Login musi zawierać same literki i numerki bojs";
	}
	
	$emailNowy=filter_var($email,FILTER_SANITIZE_EMAIL);
	if((filter_var($emailNowy,FILTER_VALIDATE_EMAIL)==false)||($email!=$emailNowy)){
		$walidacja=false;
		$_SESSION['e_email']="Troche niepoprawny email paniczu";
	}
	
	if((strlen($password)<8)||(strlen($password)>20)){
		$walidacja=false;	
		$_SESSION['e_password']="Ty no ale to hasło to też takie żeby krótsze było albo dłuższe nie iwem";
	}	
	
	if($password!=$password2){
		$walidacja=false;
		$_SESSION['e_password']="Skopiuj se jak nie potrafisz przepisac tak samo hasła";
	}
	//haż haż-haż haż	

	$passwordh=password_hash($password,PASSWORD_DEFAULT);
	if(!isset($_POST['akc'])){
		$walidacja=false;
		$_SESSION['e_akc']="No ja Cie nie zmusze ale wez kliknij to i tyle";
	}
	$cap=intval($captcha);

	if($cap!=$jakiemabyccaptcha){
		$walidacja=false;
		$_SESSION['e_captcha']="Ty to chyba bot jestes ziomus";
	}
	
	$_SESSION['pr_login']=$login;
	$_SESSION['pr_email']=$email;
	
			//NEOSTRADA, PEŁNA MOC, POŁĄCZENIE
	
	$connect= new mysqli(HOST,USERORG,PASSORG,DBORG);
	$connect->query('SET NAMES utf8');
	$result=$connect->query("SELECT id FROM users WHERE email='$email'");
	$ile_email=$result->num_rows;
	if($ile_email>0){
		$walidacja=false;
		$_SESSION['e_email']="No juz takiego goscia z takim mailem mamy wiec eluwa";
		
	}
	//był mejl teraz niczek

	$result=$connect->query("SELECT id FROM users WHERE login='$login'");
	$ile_nickow=$result->num_rows;
	if($ile_nickow>0){
		$walidacja=false;
		$_SESSION['e_login']="Nick zajęty lamusie";
	}

	
	if($walidacja==true){
		
		if($connect->query("INSERT INTO users VALUES (NULL,0,'$login','$passwordh','$email','')"))
		{
				
				$_SESSION['udane']=true;
				header('Location:index.php?strona=login');
				$connect->close();
				$result->close();
				exit();
		}
		
		
		
	}
	else
	{
		header("Location:index.php?strona=rejestr");
	$connect->close();
	$result->close();
	}
}
else{
header("Location:index.php?strona=rejestr");
}
?>