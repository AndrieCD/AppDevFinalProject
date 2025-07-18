<?php
// Reset Current Session and redirect to index.php
session_start();
session_unset();
// Destroy session cookie
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
// Prevent back button from accessing cached pages
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Location: index.php");
exit();
?>