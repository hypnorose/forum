
<?php
include 'dane.php';
session_start();


	if((!isset($_POST['login']))||(!isset($_POST['password'])))
		{
		
			header('Location:index.php');
			exit();
		}
		$connect = new mysqli(HOST,USERORG,PASSORG,DBORG);
		$connect->query('SET NAMES utf8');
		
		if(!$connect->connect_errno){
			$login=$_POST['login'];
			$password=$_POST['password'];
			$login=htmlentities($login,ENT_QUOTES,"UTF-8");
			
			if($result=$connect->query(sprintf("
			SELECT * FROM users WHERE login='%s'",
			mysqli_real_escape_string($connect,$login)
			)))
			{
				if($result->num_rows>0){
					$row=$result->fetch_assoc();
					if(password_verify($password,$row['password']))
					{
						$_SESSION['logged']=true;
						$_SESSION['id']=$row['id'];
						$id=$row['id'];
						$_SESSION['login']=$row['login'];
						$_SESSION['email']=$row['email'];
						$_SESSION['staff']=$row['staff'];
                        
                          $r=$connect->query("SELECT * FROM userstitles WHERE userid=".$row['id']."");
                    $arr=$r->fetch_all(MYSQLI_ASSOC);
                    $_SESSION['titlesid']=array();
                    foreach($arr as $entry){   
                        array_push($_SESSION['titlesid'],$entry['titlesid']);
                    }
						unset($_SESSION['error']);
						$result->free();
						if(isset($_POST['remember']))
							{
								
								$hashed=sha1($login);
								$connect->query("UPDATE users SET cookie = '$hashed' WHERE id='$id'");
								setcookie('remember',$hashed,time()+(86400*20),"/");
								
							}
						
						header('Location:index.php');
						
						
					}
					else
					{
						$_SESSION['error']="Nieprawidłowy login lub hasło";
						header('Location:index.php?strona=login');
					}
					
					
					
				}
				else{
					$_SESSION['error']="Nie ma takiego użytkownika!";
					header('Location:index.php?strona=login');
				}
				
				
			}
			
		}
		
		
	
	
?>