<?php 
	$connect=new mysqli(HOST,USERORG,PASSORG,DBORG);
	$connect->query('SET NAMES utf8');
//	$connect->query('SET CHARACTER SET utf8');
//	$connect->query('SET collation_connection = utf8_general_ci');
	$jaki;
	if(!isset($_GET['kategoria'])){
		$jaki='main';
	}
	else $jaki=$_GET['kategoria'];
	if($result=$connect->query(
	"SELECT * FROM kategorie WHERE parent = '$jaki' ORDER BY kolej ASC"
	));
	if($result2=$connect->query("
	SELECT * FROM tematy WHERE parent_kat='$jaki' ORDER BY data_ost DESC"
	));
	
	$resultczy=$connect->query("
	SELECT * FROM kategorie WHERE id='$jaki'"
	);
	if($resultczy->num_rows==0&&$jaki!='main'){
		header("Location:index.php");
		exit();
	}
	while($row=$result->fetch_assoc()){
		echo "<h3><a href='?kategoria=".$row['id']."'>".$row['name']."</a></h3>";
		echo $row['description']."<hr>";
		//TU TEŻ
		
	}
	$result->free();
    $bool=0;
    if($jaki=='main')$bool=1;
    else{
        
        
    if(isset($_SESSION['id']))
        {   
            $userid=$_SESSION['id'];

            if($result=$connect->query("SELECT * FROM iskatforall WHERE id=$jaki"))
            if($result->num_rows)$bool=1;
            
            if($result=$connect->query("SELECT * FROM kategorietitles WHERE katid=$jaki")){
                $arrk=$result->fetch_all(MYSQLI_ASSOC);
                foreach($arrk as $entry){
                    foreach($_SESSION['titlesid'] as $title){
                     $title=rtrim($title,"\0");
                       $title=str_replace("_"," ",$title);
                       // echo $title."+".$entry['titlesid'];
                        if($title==$entry['titlesid'])$bool=1;
                    }
                }
                
            }
            
        }

    }




    
	if($bool)while($row=$result2->fetch_assoc()){
		$user=$row['autor'];
		$result=$connect->query("SELECT * FROM users WHERE id='$user'");
		$row2=$result->fetch_assoc();
		echo "<a href='?strona=temat&temat=".$row['id']."'>".$row['name']."</a> <div style='text-align:right'>".$row['data']." <a href ='?strona=user&id=".$row2['id']."'>".$row2['login']."</a></div>";
		echo "<hr>";
		//WYGLĄD DO ODJEBANIA
		
	}
    else{
        echo "Brak tematów do wyświetlenia";
        
    }

	





?>