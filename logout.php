<?php
// reset sesh and redirect to index.php
session_start();
session_unset();
// destrtoy session cookies
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
// para di maka back
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Location: index.php");
exit();
?>