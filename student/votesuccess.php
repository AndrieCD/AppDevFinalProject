<?php
require_once '../utility/init.php';

// Validate session to ensure user is logged in
validateSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Vote Success</title>
  <link rel="stylesheet" href="../assets/css/student.css" />
</head>
<body>

  <!-- Top Navigation -->
  <nav class="top-nav">
    <div class="nav-left">
<img src="../assets/BobotoLogo.png"alt="BOBOTO Logo" class="nav-logo">
    </div>
    <div class="nav-right">
      <a href="student_dashboard.php" class="nav-link">Vote</a>
      <a href="../logout.php" class="nav-link">Logout</a>
    </div>
  </nav>

  <!-- Success Message Box -->
<div class="wrapper">
  <div class="success-container">
    <div class="success-icon">
      <img src="../assets/Success.png" alt="Success Check" />
    </div>
    <div class="success-title">Successfully Voted!</div>
    <div class="success-message">Your vote has been successfully recorded.</div>
    <!-- <button class="view-results-btn" onclick="window.location.href='live_results.php'">
      View Live Results
    </button> -->
  </div>
</div>


</body>
</html>
