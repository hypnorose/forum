<?php
if(isset($_SESSION['logged'])){
	header("Location:index.php");
	$_SESSION['komunikat']="Jesteś już zalogowany!";
	
}
?>

<form method=post action="scr_rejestr.php">
Login:<input type=text name="login" value="
<?php if(isset($_SESSION['pr_login']))echo $_SESSION['pr_login']; ?>
">
<?php if(isset($_SESSION['e_login'])){
	echo $_SESSION['e_login'];
	unset($_SESSION['e_login']);
}
?>
<br>
Hasło<input type=password name="password">
<?php if(isset($_SESSION['e_password'])){
	echo $_SESSION['e_password'];
	unset($_SESSION['e_password']);
}
?>
<br>
Potwierdź hasło:<input type=password name="password2"><br>
E-mail:<input type=text name="email" value="
<?php if(isset($_SESSION['pr_email']))echo $_SESSION['pr_email']; ?>
">
<?php if(isset($_SESSION['e_email'])){
	echo $_SESSION['e_email'];
	unset($_SESSION['e_email']);
}
?>
<br>
Podaj czterysta trzydziesto pierwszą cyfrę pi po przecinku(8):<input type=number min=0 max=9 name="captcha">
<?php if(isset($_SESSION['e_captcha'])){
	echo $_SESSION['e_captcha'];
	unset($_SESSION['e_captcha']);
}
?>
<br>
Akceptuję regulamin gdyby istniał:<input type=checkbox name="akc">
<?php if(isset($_SESSION['e_akc'])){
	echo $_SESSION['e_akc'];
	unset($_SESSION['e_akc']);
}
?>
<input type="submit" value="Wyślij!">
<?php
if(isset($_SESSION['udane'])){
	if($_SESSION['udane']==true)echo "No i git";
	unset($_SESSION['udane']);
}
?>
</form>