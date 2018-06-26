<?php 
	

if(!isset($_GET['id'])){
    header("Location:index.php");
    exit();
}
$userid=$_GET['id'];
 $connectorg=new mysqli(HOST,USERORG,PASSORG,DBORG);
$result=$connectorg->query("SELECT * FROM users WHERE id=$userid ");
$row=$result->fetch_assoc();
echo "<img src='avatary/".$userid.".png' alt='' width=200 height=200>";
echo $row['login'];
echo "<br>";
echo $row['email'];
echo "<br>";
echo $row['staff'];
if(!isset($_SESSION['id']))exit();
if($_SESSION['id']!=$_GET['id'])exit();
echo "<br>Zmień avatar:";

?>
<form action='scr_avupload.php' method='post' enctype="multipart/form-data">
<input type='file' name='file'>
    <input type=submit name='submit' value='Wyslij fote'>
    <input type='hidden' name='id' value='<?php echo $userid;?>'>
</form>