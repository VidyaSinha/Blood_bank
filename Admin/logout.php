<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
<<<<<<< HEAD
header("Location: login.php");
exit();
?>
=======
header("Location: admin.php");
exit();
?>
>>>>>>> 87aa80c85e6019990581e9b5e156ed9a28755a1c
