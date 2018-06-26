<?php
	echo "<div>";
	$tree=array();
	$w=0;
		if(isset($_GET['temat'])||isset($_GET['kategoria'])){
			if(isset($_GET['temat'])){	
			$connectorg= new mysqli(HOST,USERORG,PASSORG,DBORG);
			$connectorg->query('SET NAMES utf8');
			$result=$connectorg->query("SELECT * FROM tematy WHERE id=".$_GET['temat']);
			$row=$result->fetch_assoc();
			$tree[$w]="<a href='?strona=temat&temat=".$row['id']."'> ".$row['name']."</a>";
		
			$kateg=$row['parent_kat'];
			
			$w++;
			$connectorg->close();
			$result->free();
			}
			else
			{
				$kateg=$_GET['kategoria'];
				
			}
			do{
				$connectorg= new mysqli(HOST,USERORG,PASSORG,DBORG);
				$connectorg->query('SET NAMES utf8');
				$result=$connectorg->query("SELECT * FROM kategorie WHERE id='$kateg'");
				$row=$result->fetch_assoc();
				$tree[$w]="<a href='?kategoria=".$row['id']."'> ".$row['name']."</a>";
				$w++;
				$kateg=$row['parent'];
				
				
			}while($kateg!='main');
			}
			else{
				
			
		}
	
		
		
		for($i=$w-1;$i>=0;$i--){
			echo $tree[$i];
			if($i!=0)echo "->";
			
		}
	echo "</div>";

?>
