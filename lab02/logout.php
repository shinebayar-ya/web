<?php
session_start();

// Destroy the session to log the user out.
session_unset();

// Redirect the user to the login page.
header('Location: login.html');
exit();
?>
