<!-- student log in -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
    <link rel="stylesheet" href="../assets/css/student.css">
</head>
<body>

<!--your votes count SPLASH-->
<div class="splash">
    <h1>Your Vote Matters</h1>
</div>

<!--Login Container-->
<div class="container">
    <div class="left-panel">
        <h2>Welcome back!</h2>
        <p>Kindly put your Username and Password</p>

        <form action="#" method="post">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-actions">
                <span></span>
                <a href="#">Forgot Password?</a>
            </div>

            <button class="login-btn" type="submit">Login</button>
        </form>

        <div class="register-link">
            Not yet registered? <a href="#">Register now</a>
        </div>
    </div>

    <div class="right-panel">
        <div class="slideshow">
            <img class="slide active" src="../assets/image1.png" alt="Student life 1">
            <img class="slide" src="../assets/image2.png" alt="Student life 2">
            <img class="slide" src="../assets/image3.png" alt="Student life 3">
        </div>
    </div>
</div>

<!-- image slide show for news etc-->
<script>
    let currentIndex = 0;
    const slides = document.querySelectorAll('.slide');

    setInterval(() => {
        slides[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].classList.add('active');
    }, 3000);
</script>

</body>
</html>
