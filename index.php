<?php
require_once 'utility/init.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!validateEmail($email)) {
        $msg = "Invalid email format.";
    } else {
        $voter = getVoterByEmail($email);
        // also check if admin is logging in
        $admin = getAdminByEmail($email);
        if (!$voter && !$admin) {
            $msg = "Email not found.";
        } else {
            // check voter password
            if ($voter && password_verify($password, $voter['password'])) {
                // ✅ Successful login
                $_SESSION['user_id'] = $voter['id'];
                $_SESSION['user_email'] = $voter['email'];
                $_SESSION['user_type'] = 'voter'; // Set user type for redirection
                header("Location: student/student_dashboard.php"); // Redirect after login
                exit;
            } else {
                $msg = "Incorrect password.";
            }

            // check admin password
            if ($admin && password_verify($password, $admin['password'])) {
                // ✅ Successful admin login
                $_SESSION['user_id'] = $admin['id'];
                $_SESSION['user_email'] = $admin['email'];
                $_SESSION['user_type'] = 'admin'; // Set user type for redirection
                header("Location: admin/admin_dashboard.php"); // redirect to main admin page
                exit;
            } else {
                $msg = "Incorrect password.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BOBOTO Login</title>
  <link rel="stylesheet" href="assets/css/student.css" />
  <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>

  <div class="login-wrapper">

    <!-- Left Panel: Login Form -->
    <div class="login-form-panel">
      <div class="form-container">
        <h1>Welcome Back!</h1>
        <p class="subtitle">Enter Your Email and Password</p>

        <!-- Login Form -->
        <form  method="POST">
          <fieldset>      
            <input type="text" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
          </fieldset>
        </form>
        <?php if (!empty($msg)) echo "<p class='error-message'>$msg</p>"; ?>
        <p>Don't have an account yet? Send a <a href="https://www.feutech.edu.ph/about-us/offices/itso">ticket!</a></p>
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
