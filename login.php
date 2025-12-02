<?php
include('config.php'); // includes safe session_start()

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  if (empty($email) || empty($password)) {
    $error = "All fields are required.";
  } else {
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user'] = $user['username'];
      header('Location: home.php');
      exit;
    } else {
      $error = "Invalid email or password.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | CoffeeShop</title>
  <link rel="stylesheet" href="style.css">
  <style>
    :root {
      --main-color: #6f4e37; /* coffee brown */
      --bg: #0e0e0e;
    }
    body {
      background: var(--bg);
      font-family: "Raleway", sans-serif;
      color: #fff;
      margin: 0;
      padding: 0;
    }
    .auth-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .auth-box {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(8px);
      border-radius: 1rem;
      padding: 3rem 4rem;
      box-shadow: 0 0 20px rgba(0,0,0,0.4);
      width: 380px;
      color: #fff;
    }
    h2 {
      text-align: center;
      color: var(--main-color);
      font-size: 2.8rem;
      margin-bottom: 1.5rem;
    }
    input {
      width: 100%;
      padding: 1rem;
      margin: 1rem 0;
      border-radius: 0.6rem;
      border: none;
      background: rgba(255,255,255,0.2);
      color: #fff;
      font-size: 1.5rem;
    }
    button {
      width: 100%;
      background: var(--main-color);
      color: var(--bg);
      border: none;
      border-radius: 0.6rem;
      padding: 1rem;
      font-size: 1.6rem;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: var(--bg);
      color: var(--main-color);
      border: 1px solid var(--main-color);
    }
    .error {
      color: #ff7b7b;
      text-align: center;
      font-size: 1.4rem;
      margin-bottom: 1rem;
    }
    p {
      text-align: center;
      font-size: 1.4rem;
      margin-top: 1rem;
    }
    a {
      color: var(--main-color);
      text-decoration: underline;
    }
    header {
      background: rgba(0,0,0,0.8);
      position: fixed;
      top: 0;
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.8rem 3rem;
      box-shadow: 0 4px 10px rgba(0,0,0,0.4);
      z-index: 999;
    }
    .navbar a {
      margin: 0 1rem;
      color: #fff;
      text-decoration: none;
      padding: 0.6rem 1rem;
      border-radius: 0.5rem;
      transition: 0.3s;
    }
    .navbar a:hover {
      background: var(--main-color);
      color: #fff;
    }
  </style>
</head>
<body>
  <header class="header">
    <a href="index.php" class="logo">
      <img src="assets/logo1.jpeg" alt="Logo" style="height:50px; border-radius:8px;">
    </a>
    <nav class="navbar">
      <a href="index.php#home">Home</a>
      <a href="index.php#about">About</a>
      <a href="index.php#menu">Menu</a>
      <a href="index.php#products">Products</a>
      <a href="index.php#review">Review</a>
      <a href="index.php#contact">Contact</a>
      <a href="index.php#blogs">Blogs</a>
      <?php
        if (isset($_SESSION['user'])) {
          echo "<a href='home.php' style='background:var(--main-color); color:#fff; border-radius:0.5rem;'>Welcome, " . htmlspecialchars($_SESSION['user']) . "</a>";
          echo "<a href='#' id='logout-link'>Logout</a>";
        } else {
          echo "<a href='login.php'>Login</a>";
          echo "<a href='register.php'>Sign Up</a>";
        }
      ?>
    </nav>
  </header>

  <div class="auth-container">
    <div class="auth-box">
      <h2>Login</h2>
      <?php if ($error) echo "<p class='error'>$error</p>"; ?>
      <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
      </form>
      <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
  </div>

  <!-- Logout confirmation modal -->
  <div id="logoutModal" class="modal" style="display:none;">
    <div class="modal-content" style="
      background: rgba(255,255,255,0.1);
      backdrop-filter: blur(10px);
      border: var(--border);
      border-radius: 1rem;
      padding: 2rem;
      text-align: center;
      color: #fff;
      width: 350px;
      margin: 15% auto;
      box-shadow: 0 5px 15px rgba(0,0,0,0.4);
    ">
      <h2 style="color: var(--main-color); margin-bottom: 1rem;">Log Out?</h2>
      <p style="font-size: 1.5rem; margin-bottom: 2rem;">Are you sure you want to log out?</p>
      <button id="confirmLogout" style="padding: 0.8rem 2rem; background: var(--main-color); border: none; border-radius: 0.8rem; font-weight: 600; cursor: pointer;">Yes, Log Out</button>
      <button id="cancelLogout" style="padding: 0.8rem 2rem; background: var(--bg); color: var(--main-color); border: 1px solid var(--main-color); border-radius: 0.8rem; font-weight: 600; cursor: pointer; margin-left: 1rem;">Cancel</button>
    </div>
  </div>

  <script>
    const logoutLink = document.getElementById('logout-link');
    const modal = document.getElementById('logoutModal');
    const confirmLogout = document.getElementById('confirmLogout');
    const cancelLogout = document.getElementById('cancelLogout');

    if (logoutLink) {
      logoutLink.addEventListener('click', (e) => {
        e.preventDefault();
        modal.style.display = 'block';
      });
    }

    if (confirmLogout) {
      confirmLogout.addEventListener('click', () => {
        window.location.href = 'logout.php';
      });
    }

    if (cancelLogout) {
      cancelLogout.addEventListener('click', () => {
        modal.style.display = 'none';
      });
    }

    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
  </script>

</body>
</html>
