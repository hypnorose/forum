<?php session_start();
session_unset();
if (isset($_COOKIE['remember'])) {
    unset($_COOKIE['remember']);
    setcookie('remember', '', time() - 3600, '/'); 
}
header('Location: index.php');
?>