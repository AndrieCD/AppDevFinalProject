<?php
// bundle up all utility functions in one file para isang require statemet lang

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
}

require_once 'db_connect.php';
require_once 'admin_functions.php';
require_once 'voter_functions.php';
require_once 'validation.php';
require_once 'candidate_functions.php';
require_once 'party_functions.php';
require_once 'voting_functions.php';
require_once 'position_functions.php';
?>
