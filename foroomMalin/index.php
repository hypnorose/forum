<?php session_start();

include 'dane.php';
 ?>
<!doctype HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
		
	<header>
	<h1 id='logoindex'><a  href="?">FOROOM</a></h1>
	</header>
	<section style='text-align:right;margin-right:20px;'>
		<nav>
	<a class='float' href="?strona=rejestr">Rejestracja</a>
	<a class='float'  href="?strona=login">Loging</a>
            
          <?php 
            if(isset($_SESSION['id'])){
                echo   "<a class='float' href='?strona=user&id=";
                echo $_SESSION['id']."'>Mój profil</a>"; }?>
		</nav>
	</section>
	
	<div class="clear"></div>
	<section class='centeredX' style="margin-bottom:10px;"><?php include 'func_tree.php'; ?></section>
	<br>
	Wyszukanie<br>
	<section>
	<form method=post action="znajdz.php">
		<input type=text name="znajdz">
		<input type="submit" value="Szukaj">
	</form>
	</section>
	<section id="container">
	<aside>
	<?php 
		if(isset($_SESSION['komunikat'])){
		echo $_SESSION['komunikat'];
		unset($_SESSION['komunikat']);
		echo "<br>";
		}
		
		if(isset($_COOKIE['remember'])){
			$hashed=$_COOKIE['remember'];
			$connect = new mysqli(HOST,USERORG,PASSORG,DBORG);
			if($result=$connect->query("SELECT * FROM users WHERE cookie='$hashed'"))
			{		
				if($result->num_rows>0){
					$row=$result->fetch_assoc();
					$_SESSION['logged']=true;
					$_SESSION['id']=$row['id'];
					$_SESSION['login']=$row['login'];
					$_SESSION['email']=$row['email'];
					$_SESSION['staff']=$row['staff'];
                    $r=$connect->query("SELECT * FROM userstitles WHERE userid=".$row['id']."");
                    $arr=$r->fetch_all(MYSQLI_ASSOC);
                    $_SESSION['titlesid']=array();
                    foreach($arr as $entry){   
                        array_push($_SESSION['titlesid'],$entry['titlesid']);
                    }
					echo "Jesteś pamiętany na tym urządzeniu!<br>";
					
				}
				//echo "$hashed";
			}
		}
	
		if(isset($_SESSION['udane'])){echo "Rejestracja udana, możesz się zalogować!";unset($_SESSION['udane']);}
		else if(isset($_SESSION['logged'])){
			
			$login=$_SESSION['login'];
			
			echo "Jesteś zalogowany jako ".$login;
			echo "<br>";
			echo "<a href='scr_logout.php'>Wyloguj sie</a>";
		}
		else echo "Witamy na foroomie!";
	
	?>
	</aside>
	
	<?php
	if(isset($_GET['kategoria'])&&isset($_SESSION['logged'])){
		$_SESSION['kategoria']=$_GET['kategoria'];
		echo "<a style='float:right' href='?strona=addthread'>Dodaj wątek!</a>";
	}
	if(isset($_GET['strona']))
		{
			if($_GET['strona']!='addthread')unset($_SESSION['kategoria']);
		}
	
	
	?>
	
	<main>
	<?php 
	if(!isset($_GET['strona'])) include 'main.php';
	else if($_GET['strona']=='addthread') include 'form_addthread.php';
	else if($_GET['strona']=='temat') include 'thread.php';
	else if($_GET['strona']=='rejestr')include 'form_rejestr.php'; 
	else if($_GET['strona']=='login')include 'form_login.php';
    else if($_GET['strona']=='user')include 'user.php';
	
	else header('Location:index.php');
		
	?>
	
	</main>
	</section>
	<section class='clear'></section>
	<section  style="text-align: center;
    margin-top: 20px;
    position: relative;
    left: 50%;
    bottom: 5px;
    transform: translate(-50%, 0);

}"><a href="admin_panel.php">Panel administracyjny</a></section>
	
</body>

</html>