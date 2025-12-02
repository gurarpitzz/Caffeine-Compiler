<?php
include('config.php');

// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $check = mysqli_prepare($conn, "SELECT id FROM users WHERE email=?");
        mysqli_stmt_bind_param($check, "s", $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            $error = "Email already registered.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed);
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Registration successful! Redirecting to login...'); window.location='login.php';</script>";
                exit;
            } else {
                $error = "Database error: " . mysqli_error($conn);
            }
        }
        mysqli_stmt_close($check);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | CoffeeShop</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background: var(--bg);
      color: #fff;
      font-family: "Raleway", sans-serif;
      margin: 0;
      padding: 0;
    }

    .header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
      background: rgba(0, 0, 0, 0.85);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 3rem;
    }

    .navbar a {
      color: #fff;
      padding: 0.6rem 1.2rem;
      border-radius: 8px;
      transition: 0.3s;
    }

    .navbar a:hover {
      background: var(--main-color);
      color: var(--bg);
    }

    /* Brown box for Welcome user */
    .welcome-box {
      background-color: #5c4033; /* coffee-brown tone */
      padding: 0.6rem 1.2rem;
      border-radius: 8px;
      color: #fff;
      font-weight: 600;
      margin-left: 1rem;
    }

    .auth-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      padding-top: 80px;
    }

    .auth-box {
      background: rgba(255,255,255,0.1);
      backdrop-filter: blur(8px);
      border-radius: 1rem;
      padding: 3rem 4rem;
      box-shadow: 0 0 10px rgba(0,0,0,0.4);
      width: 380px;
    }

    h2 {
      text-align: center;
      color: var(--main-color);
      font-size: 2.8rem;
      margin-bottom: 1rem;
    }

    .auth-box input {
      width: 100%;
      padding: 1rem;
      margin: 0.8rem 0;
      border-radius: 0.6rem;
      border: none;
      background: rgba(255,255,255,0.2);
      color: #fff;
      font-size: 1.5rem;
    }

    .auth-box button {
      width: 100%;
      background: var(--main-color);
      color: var(--bg);
      border: none;
      border-radius: 0.6rem;
      padding: 1rem;
      font-size: 1.6rem;
      font-weight: 600;
      cursor: pointer;
      margin-top: 1rem;
    }

    .auth-box button:hover {
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
  </style>
</head>
<body>
  <header class="header">
    <a href="index.php" class="logo"><img src="assets/logo1.jpeg" alt="Logo" height="50"></a>
    <nav class="navbar">
      <a href="index.php#home">Home</a>
      <a href="index.php#about">About</a>
      <a href="index.php#menu">Menu</a>
      <a href="index.php#products">Products</a>
      <a href="index.php#review">Review</a>
      <a href="index.php#contact">Contact</a>
      <a href="index.php#blogs">Blogs</a>

      <?php if (isset($_SESSION['user'])): ?>
        <span class="welcome-box">Welcome, <?= htmlspecialchars($_SESSION['user']) ?></span>
        <a href="#" id="logout-link">Logout</a>
      <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Sign Up</a>
      <?php endif; ?>
    </nav>
  </header>

  <div class="auth-container">
    <div class="auth-box">
      <h2>Create Account</h2>
      <?php if ($error) echo "<p class='error'>$error</p>"; ?>
      <form method="POST">
        <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($username ?? '') ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($email ?? '') ?>" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
      </form>
      <p>Already have an account? <a href="login.php">Login</a></p>
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
