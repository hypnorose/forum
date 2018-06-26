<?php
	if(!isset($_GET['temat'])){
		header("Location:index.php");
		exit();
	}
	$connectposty= new mysqli(HOST,USERPOSTY,PASSPOSTY,DBPOSTY);
	$connectposty->query('SET NAMES utf8');
	$result=$connectposty->query("
	SELECT * FROM posty WHERE parent_temat=".$_GET['temat']." ORDER BY data
	");
	$connectorg=new mysqli(HOST,USERORG,PASSORG,DBORG);
	$connectorg->query('SET NAMES utf8');
	while($row=$result->fetch_assoc()){
		$rowname=$connectorg->query("
		SELECT * FROM users WHERE id=".$row['autor']
		);
		$name=$rowname->fetch_assoc(); 
		echo "<img height=100 width=100 src='avatary/".$name['id'].".png'><a href='?strona=user&id=".$name['id']."' >".$name['login']."</a>------".$row['data']."<br>";
        $row['tresc']=str_replace(PHP_EOL,"<br/>",$row['tresc']);
		echo $row['tresc']."<hr>";
		//TU TRZEBA WYGLĄD TEGO
		
	}
	if(isset($_SESSION['logged']))
	{
		echo "<form style='text-align:center' action='scr_addpost.php' method='post'>

			
			Treść:<textarea style='width:300px;height:100px;' name='tresc'></textarea><br>
			<input type='submit' value='Odpowiedz!'>";
		
			if(isset($_SESSION['er_addpost'])){
				echo $_SESSION['er_addpost'];
				unset($_SESSION['er_addpost']);
			}
		
			$_SESSION['temat_addpost']=$_GET['temat'];


			echo "</form>";
					
		
		
		
	}
?>