<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'db_connect.php';
require_once 'admin_functions.php';
require_once 'voter_functions.php';
require_once 'validation.php';
require_once 'candidate_functions.php';
require_once 'party_functions.php';
require_once 'voting_functions.php';
?>
