<!-- Php area is referred from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php -->
<?php
// the page for logout the user

session_start();
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect
header("location: login.php");
exit;

?>