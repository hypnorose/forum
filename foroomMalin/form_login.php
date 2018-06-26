<?php

if(isset($_SESSION['logged'])){
	header("Location:index.php");
	$_SESSION['komunikat']="Jesteś już zalogowany!";
	
}
?>
<form style="margin:auto;text-align:center;" method=post action="scr_login.php">
<section>
Nazwa użytkownika:<br><input name='login'><br>
Hasło:<br><input type=password name='password'><br>
Zapamiętaj mnie:<input type=checkbox name='remember'>
<br><input type=submit value='PEŁNA MOC'>
<?php if(isset($_SESSION['error']))echo $_SESSION['error']; ?>
</section>
</form>