<?php
session_start(); // Start the session if not already started

// Check if a session is active
if(isset($_SESSION['loggedIn'])) {
    // If session is active, destroy it
    session_destroy();
}

// Redirect to the login page
header("Location: login.php");
exit; // Ensures that no other content is sent
?>
