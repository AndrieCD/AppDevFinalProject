<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Voting Page</title>
  <link rel="stylesheet" href="../assets/css/student.css" />
</head>
<body>

  <!-- Top Navigation Bar -->
  <nav class="top-nav">
    <div class="nav-left">
      <img src="../assets/BobotoLogo.png" alt="BOBOTO Logo" class="nav-logo">
    </div>
    <div class="nav-right">
      <a href="#" class="nav-link">Vote</a>
      <a href="index.php" class="nav-link">Log-out</a>
    </div>
  </nav>

  <!-- Welcome Banner (outside green nav) -->
  <div class="welcome-banner">
    <h2>Welcome, Student Name!</h2>
  </div>

  <!-- Splash Screen -->
  <div id="splash-screen">
    <div class="splash-content">
      <img src="../assets/Logo.png" alt="Vote Logo" class="splash-logo" />
      <h1 style="font-size: 48px;">Your vote matters</h1>
    </div>
  </div>

  <!-- Main Dashboard Container -->
  <div class="dashboard-container">

    <!-- Election Info -->
    <section class="election-info">
      <h3>Student Organization Election 2025</h3>
      <p>Voting Period: July 20–25, 2025</p>
    </section>

    <!-- Voting Form -->
    <form class="voting-form" method="POST" action="votesuccess.php">

      <!-- PRESIDENT -->
      <div class="position-group">
        <h4>President</h4>
        <div class="candidate-grid">
          <label class="candidate-card">
            <input type="radio" name="president" value="1" required>
            <h5>Naruto Uzumaki</h5>
            <p>Party A</p>
          </label>

          <label class="candidate-card">
            <input type="radio" name="president" value="2">
            <h5>Sasuke Uchiha</h5>
            <p>Party B</p>
          </label>
        </div>
      </div>

      <!-- VICE PRESIDENT -->
      <div class="position-group">
        <h4>Vice President</h4>
        <div class="candidate-grid">
          <label class="candidate-card">
            <input type="radio" name="vp" value="3" required>
            <h5>Hinata</h5>
            <p>Party A</p>
          </label>

          <label class="candidate-card">
            <input type="radio" name="vp" value="4">
            <h5>Sakura</h5>
            <p>Party B</p>
          </label>
        </div>
      </div>

      <!-- SECRETARY -->
      <div class="position-group">
        <h4>Secretary</h4>
        <div class="candidate-grid">
          <label class="candidate-card">
            <input type="radio" name="secretary" value="5" required>
            <h5>Shikamaru</h5>
            <p>Party C</p>
          </label>

          <label class="candidate-card">
            <input type="radio" name="secretary" value="6">
            <h5>Shikadai</h5>
            <p>Party D</p>
          </label>
        </div>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="vote-now-btn">Submit Vote</button>
    </form>
  </div>

  <!-- Splash Screen Script -->
  <script>
    window.addEventListener("load", () => {
      const splash = document.getElementById("splash-screen");
      setTimeout(() => {
        splash.classList.add("fade-out");
      }, 2000); // Show for 2 seconds
    });
  </script>

</body>
</html>
