<style>
    body{
        display:grid;
        grid-gap:10px;
        grid-template-columns:repeat(3,1fr);
    }
    body section,body div{
        border:1px solid black;
    }
</style>
<?php session_start();	include "dane.php";
	echo "<a href='index.php'>BACK</a>";
	function wypiszKateg($parent,$level){
		$connectorg= new mysqli(HOST,USERORG,PASSORG,DBORG);
		$connectorg->query('SET NAMES utf8');
		$result=$connectorg->query("SELECT * FROM kategorie WHERE parent='$parent' ORDER by kolej");
        $flag=0;
        $rowall=$result->fetch_all(MYSQLI_ASSOC);
    
        foreach($rowall as $k => $row){

            echo $level.$row['name'];
			echo "<button name='usun' value='".$row['id']."'>Usuń</button>";
			echo "<button name='edytuj' value='".$row['id']."'>edytuj</button>";
              if($flag)echo "<button name='up' value='".$row['id'].";".$pop."'>W górę</button>";
            if($k!=count($rowall)-1){$new=$result;
           $next=$rowall[$k+1]['id'];
            echo "<button name='up' value='".$row['id'].";".$next."'>W dół</button>";
                                }
            echo "<br>";
			echo $level."-<button name='parent' value='".$row['id']."'>+</button>";
            echo "<br>";
       
			wypiszKateg($row['id'],$level.'-');
			
            $pop=$row['id'];
            $flag=1;
        }
        
        
		/*while($row=$result->fetch_assoc()){
			echo $level.$row['name'];
			echo "<button name='usun' value='".$row['id']."'>Usuń</button>";
			echo "<button name='edytuj' value='".$row['id']."'>edytuj</button>";
              if($flag)echo "<button name='up' value='".$row['id'].";".$pop."'>W górę</button>";
            if(1){$new=$result;
           $next=$new->fetch_assoc()['id'];
            echo "<button name='down' value='".$row['id'].";".$next."'>W dół</button>";
                                }
            echo "<br>";
			echo $level."-<button name='parent' value='".$row['id']."'>+</button>";
            echo "<br>";
       
			wypiszKateg($row['id'],$level.'-');
			
            $pop=$row['id'];
            $flag=1;
		}
		*/
		
		
		$connectorg->close();
		$result->free();
	}



	if(!isset($_SESSION['staff'])){
		$_SESSION['komunikat']="Musisz być zalogowany jako administrator!";
		header("Location:index.php");
		exit();
	}
	if($_SESSION['staff']<100){
		$_SESSION['komunikat']="Musisz być zalogowany jako administrator!";
		header("Location:index.php");
		exit();	
	}
	echo "<section style='border:1px solid black;float:left;'>";
		$connectorg= new mysqli(HOST,USERORG,PASSORG,DBORG);
		$connectorg->query('SET NAMES utf8');
	$result=$connectorg->query("SELECT * FROM users");

	echo "<form action='admin_usunuser.php' method=post><table>";
	echo "<tr style='background-color:green;color:yellow;'><td>Login</td><td>E-mail</td><td>Poziom staffu</td></tr>";
	while($row=$result->fetch_assoc()){
		echo "<tr><td>".$row['login']."</td><td> ".$row['email']."</td><td> ".$row['staff'].
		"</td><td><input type='checkbox' name='".$row['id']."'</td><br></tr>";
		
		
	}
	
	echo "</table><input type=submit value='Usuń zaznaczonych użytkowników!'></form>";
		if(isset($_SESSION['er_usun'])){echo $_SESSION['er_usun'];unset($_SESSION['er_usun']);}

	$connectorg->close();
		$result->free();
	echo "</section><section><form method='post' action='admin_dodajkat.php'>";
    echo "Wpisz nazwę i opis kategorii, następnie wybierz miejsce dla nowej kategorii lub kategorię której nazwa i opis ma zostać zmienione na wpisane";
	echo "<input placeholder='Nazwa'  name='nazwakat'/ ><br>";
	echo "<input placeholder='Opis' name='opiskat'  /><br>";	
	echo "-<button name='parent' value='main'>+</button><br>";
	wypiszKateg('main','-');

	
		
	echo "</form></section>";
		$connectorg= new mysqli(HOST,USERORG,PASSORG,DBORG);
		$connectorg->query('SET NAMES utf8');
    echo "<section>";
    $result=$connectorg->query("SELECT * FROM ranks ORDER BY prog");
    $arr=$result->fetch_all(MYSQLI_ASSOC);
	echo "<form action='#' method=post>";
    foreach($arr as $entry){
        echo $entry['name']." ".$entry['prog']."<button name='usunr' value='".$entry['prog']."'>X</button><br>";
        
    }
	echo "</form>";
    if(isset($_POST['prog'])||isset($_POST['usunr'])){
		
			echo $_POST['usun'];
		if(isset($_POST['usun'])){
				echo "sie23ma";
			$id=$_POST['usun'];
			$connectorg->query("DELETE FROM ranks WHERE prog='$id'");
			header("Location:admin_panel.php");
        exit();
		echo $id;
	
		}
		else{
      
        $prog=$_POST['prog'];
        $name=$_POST['name'];
        $connectorg->query("INSERT INTO ranks (prog,name) VALUES ('$prog','$name') ON DUPLICATE KEY UPDATE name='$name'" );
        header("Location:admin_panel.php");
        exit();
		}
    }

    
    echo "<form method=post action='#'>";
    echo "Nazwa:<input type='text' name='name' required><br>";
    echo "Próg:<input type='number' name='prog' required>";
    echo "<input type=submit>";
	echo "</form></section>";
	

    echo "<section>";


    
    if(isset($_POST['titles'])){
        $name=$_POST['titles'];
        $color=$_POST['color'];
        $connectorg->query("INSERT INTO titles (name,color) VALUES ('$name','$color') ON DUPLICATE KEY UPDATE color='$color'");
                header("Location:admin_panel.php");
        exit();

    }
    if(isset($_POST['usuntitles'])){
        $id=$_POST['usuntitles'];
        $connectorg->query("DELETE FROM titles WHERE name='$id'");
                header("Location:admin_panel.php");
        exit();
    }
        
    $result->free();
    $result=$connectorg->query("SELECT * FROM titles");
    $arr=$result->fetch_all(MYSQLI_ASSOC);
    echo "<form action='#' method='post'>";
    foreach($arr as $entry){
        echo "<span style='color:".$entry['color']."'>".$entry['name']."</span><button name='usuntitles' value='".$entry['name']."'>X</button>";                                     
        
        echo "</br>";
        
    }
echo "</form>";
  
    $result->free();
    echo "<form method=post action='#'>";
    echo "Tytuł<input type='text' name='titles' required ><br>";
    echo "Kolor<input type='color' name='color' required>";
    echo "<input type='submit'>";
    echo "</form>";
    echo "</section>";
	
    
 
    $resultut=$connectorg->query("SELECT * FROM userstitles");
    $resultt=$connectorg->query("SELECT * FROM titles");
 



if(isset($_POST['ut'])){
    unset($_POST['ut']);
    foreach($_POST as $arr=>$v){
    $a=explode(";",$arr);
    print_r($a);
    $userid=$a[0];
    $tname=$a[1];
        if($v==1)$connectorg->query("DELETE FROM userstitles WHERE userid='$userid' AND titlesid='$tname'");
   
    else $connectorg->query("INSERT INTO userstitles (userid,titlesid)VALUES ('$userid','$tname') ");
    }
       header("Location:admin_panel.php");
        exit();
}





// USERS X TITLES

 echo "<section >";
echo "<form action='#' method=post style='display:grid;grid-template-columns:repeat(".($resultt->num_rows+1).",1fr);grid-auto-rows:40px;'>";
     
   

    $resultu=$connectorg->query("SELECT * FROM users");
    $arrt=$resultt->fetch_all(MYSQLI_ASSOC);
    $arrut=$resultut->fetch_all(MYSQLI_ASSOC);
    $arru=$resultu->fetch_all(MYSQLI_ASSOC);
    $macierz=array();
    
    foreach($arrut as $entryut){
        $entryut['titlesid']=rtrim($entryut['titlesid'],"\0");
        $entryut['titlesid']=str_replace("_"," ",$entryut['titlesid']);
        $macierz[$entryut['userid']][$entryut['titlesid']]=1;;
   
    }
    echo "<div></div>";
    foreach($arrt as $entryt){
        echo "<div style='color:".$entryt['color'].";'>";
        echo $entryt['name'];
        echo "</div>";
    }  
    
    foreach($arru as $entryu){
        echo "<div>".$entryu['login']."</div>";
        foreach($arrt as $entryt){
            if(isset($macierz[$entryu['id']][$entryt['name']]));
            echo "<div>";
            
            
           $entryt['name']=rtrim($entryt['name'],"\0");;
            echo "<button name='".$entryu['id'].";".$entryt['name']."' value=";
              if(isset($macierz[$entryu['id']][$entryt['name']]))echo "1";
                else echo 0;
            echo ">";
            if(isset($macierz[$entryu['id']][$entryt['name']]))echo "Tak";
            else echo "Nie";
            echo "</button>";
         
            
            echo "</div>";
         
        }
    }
    echo "<input type='hidden' name='ut' value='1'>";
     echo "</form>";
    echo "</section>";

    // KONIEC USERS X TITLES
        
        
    // KATEGORIE X TITLES

    // WYKONANIE KXT
 
    if(isset($_POST['kt'])){
       
        unset($_POST['kt']);
        $arr;
        $v;
        foreach($_POST as $k => $a){
            $arr=explode(";",$k);
            $v=$a;
        }
        
        if($v)$v=1;
        else $v=0;
        
        $id=$arr[0];
        if($arr[1]=="all"){
           
            if(!$v){
                $v=!$v;
                $connectorg->query("INSERT INTO  iskatforall (id,v) VALUES ($id,$v)");}
            else {
                $connectorg->query("DELETE FROM iskatforall WHERE  id='$id'");
            }
        }
        else{
            $tid=$arr[1];
            
             $tid=str_replace("_"," ",$tid);
            if(!$v){
                $connectorg->query("INSERT INTO kategorietitles (katid,titlesid) VALUES ($id,'$tid')");
                
            }
            else $connectorg->query("DELETE FROM kategorietitles WHERE katid=$id AND titlesid='$tid'");
            
        }

           if(!headers_sent())header("Location:admin_panel.php");
           
    
    }







    // FORMULARZE KXT
        echo "<section>";
 
        $resultk=$connectorg->query("SELECT * FROM kategorie");
        $resultt=$connectorg->query("SELECT * FROM titles");
        $resultkt=$connectorg->query("SELECT * FROM kategorietitles");
        $resultis=$connectorg->query("SELECT * FROM iskatforall");
        $arrk=$resultk->fetch_all(MYSQLI_ASSOC);    
        $arrt=$resultt->fetch_all(MYSQLI_ASSOC);    
        $arrkt=$resultkt->fetch_all(MYSQLI_ASSOC);
        $arris=$resultis->fetch_all(MYSQLI_ASSOC);
        echo "<form method=post style='display:grid;grid-template-columns:repeat(".($resultk->num_rows+1).",1fr)'>";
        echo "<div></div>";
        foreach($arrk as $entry){
            echo "<div>";
            echo $entry['name'];
            echo "</div>";
        }
        $macierz=array();
        foreach($arrkt as $entry){
            $entry['titlesid']=rtrim($entry['titlesid'],"\0");
            $entry['titlesid']=str_replace("_"," ",$entry['titlesid']);
            $macierz[$entry['katid']][$entry['titlesid']]=1;
        }
        $macierzis=array();
        foreach($arris as $entry){
            if($entry['v']==1){
                $macierzis[$entry['id']]=1;
            }
        }
        
    
        foreach($arrt as $entryt){
             echo "<div>".$entryt['name']."</div>";
            foreach($arrk as $entryk){
                $off=isset($macierzis[$entryk['id']]);
                echo "<div><button name='".$entryk['id'].";".$entryt['name']."' ";
                if($off)echo " disabled ";
                if(isset($macierz[$entryk['id']]
                [$entryt['name']]))echo "value=1 >Tak";
                else echo "value=0 >Nie";
                echo "</button></div>";
            }   
        }
        echo "<div>Wszyscy</div>";
  
        foreach($arrk as $entryk){
                  echo "<div>";
             $off=isset($macierzis[$entryk['id']]);
            echo "<button name='".$entryk['id'].";all' value=$off><b>";
            if($off)echo "Tak";
            else echo "Nie";
            echo "</b></button>";
              echo "</div>";
        }
       


        echo "<input type=hidden name='kt' value='1'>";
        echo "</form>";
        echo "</section>";



?>