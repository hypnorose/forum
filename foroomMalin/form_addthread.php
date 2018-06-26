<?php
if(!isset($_SESSION['kategoria'])){
	header('Location: index.php');
	exit();
}
$connect = new mysqli(HOST,USERORG,PASSORG,DBORG);
$result=$connect->query("SELECT name FROM kategorie WHERE id=".$_SESSION['kategoria']);
if($result->num_rows>0){
	$row=$result->fetch_assoc();
	echo "Dodajesz wątek do kategorii: ".$row['name'];
}
?>

<form action='scr_addthread.php' method='post'>

Nazwa:<input name='name'><br>
Treść:<textarea style="width:300px;height:200px;" name='tresc'></textarea><br>
<input type='submit' value="Utwórz wątek!">
<?php
if(isset($_SESSION['er_addthread'])){
	echo $_SESSION['er_addthread'];
	unset($_SESSION['er_addthread']);
}
?>



</form>