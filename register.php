<?php
require_once 'utility/init.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if (!validateEmail($email)) {
        $msg = "Invalid email format.";
    } elseif ($password !== $confirm) {
        $msg = "Passwords do not match.";
    } else {
        // Check if user already exists
        $existingUser = getVoterByEmail($email) ?? getAdminByEmail($email);
        if ($existingUser) {
            $msg = "An account with this email already exists.";
        } else {
            insert_voter($email, $password);

            $voter = getVoterByEmail($email);
            $_SESSION['user_id'] = $voter['id'];
            $_SESSION['user_email'] = $voter['email'];
            $_SESSION['user_type'] = 'voter'; 
            header("Location: student/student_dashboard.php"); // Redirect to student dashboard
            exit;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BOBOTO Register</title>
  <link rel="stylesheet" href="assets/css/student.css" />
  <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>

  <div class="login-wrapper">

    <!-- Left Panel: Login Form -->
    <div class="login-form-panel">
      <div class="form-container">
        <h1>Create Account</h1>
          <p class="subtitle">Enter Your Email and Password</p>

          <form method="POST">
            <fieldset>      
              <input type="text" name="email" placeholder="Email" required />
              <input type="password" name="password" placeholder="Password" required />
              <input type="password" name="confirm" placeholder="Confirm Password" required />
              <button type="submit">Register</button>
            </fieldset>
          </form>
          <?php if (!empty($msg)) echo "<p class='error-message'>$msg</p>"; ?>
          <p style="text-align:center; margin-top: 10px;">
          Already have an account? <a href="index.php">Log in here</a>
        </p>
      </div>
    </div>

    <!-- Right Panel: Logo & Branding -->
    <div class="login-image-panel">
      <div class="image-overlay">
        <img src="assets/LogInSide.png" alt="Philippines Map" class="map-overlay">
      </div>
    </div>

  </div>

</body>
</html>
