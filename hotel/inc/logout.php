
<?php
// logout.php
session_start(); // Start the session

// Destroy all session data
session_unset();
session_destroy();

// Redirect to the homepage or login page
header("Location: index.php"); // Change 'index.php' to whatever page you want to redirect to after logout
exit();
?>
