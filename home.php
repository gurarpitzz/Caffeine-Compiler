<?php
// ✅ Start session safely (prevents duplicate session_start warnings)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome | CoffeeShop</title>
  <link rel="stylesheet" href="style.css">
  <style>
    :root {
      --bg: #2c1810;
      --main-color: #c49a6c;
      --border: 1px solid rgba(255, 255, 255, 0.2);
    }

    body {
      background: var(--bg);
      color: #fff;
      text-align: center;
      font-family: "Raleway", sans-serif;
      margin: 0;
      padding: 0;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      background: rgba(0, 0, 0, 0.4);
      backdrop-filter: blur(10px);
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .logo img {
      width: 90px;
      border-radius: 50%;
    }

    .navbar a {
      color: #fff;
      text-decoration: none;
      margin: 0 1rem;
      font-weight: 600;
      transition: 0.3s;
    }

    .navbar a:hover {
      color: var(--main-color);
    }

    .welcome {
      margin-top: 10rem;
    }

    h1 {
      font-size: 3.5rem;
      color: var(--main-color);
    }

    p {
      font-size: 1.8rem;
      margin: 1rem 0;
    }

    a.button {
      display: inline-block;
      background: var(--main-color);
      color: var(--bg);
      padding: 1rem 2rem;
      border-radius: 1rem;
      font-size: 1.6rem;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
    }

    a.button:hover {
      background: var(--bg);
      color: var(--main-color);
      border: 1px solid var(--main-color);
    }

    /* Logout Modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 100;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.6);
    }

    .modal-content {
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
    }

    button {
      padding: 0.8rem 2rem;
      border: none;
      border-radius: 0.8rem;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
    }

    #confirmLogout {
      background: var(--main-color);
      color: var(--bg);
    }

    #cancelLogout {
      background: var(--bg);
      color: var(--main-color);
      border: 1px solid var(--main-color);
      margin-left: 1rem;
    }

    button:hover {
      opacity: 0.8;
    }
  </style>
</head>
<body>

  <header class="header">
    <a href="index.php" class="logo"><img src="assets/logo1.jpeg" alt="Logo"></a>

    <nav class="navbar">
      <a href="index.php#home">Home</a>
      <a href="index.php#about">About</a>
      <a href="index.php#menu">Menu</a>
      <a href="index.php#products">Products</a>
      <a href="index.php#review">Review</a>
      <a href="index.php#contact">Contact</a>
      <a href="index.php#blogs">Blogs</a>

      <?php if (isset($_SESSION['user'])): ?>
        <a href="home.php">Welcome, <?= htmlspecialchars($_SESSION['user']); ?></a>
        <a href="#" id="logout-link">Logout</a>
      <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Sign Up</a>
      <?php endif; ?>
    </nav>
  </header>

  <div class="welcome">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['user']); ?> ☕</h1>
    <p>Glad to see you at CoffeeShop!</p>
    <a href="logout.php" class="button">Logout</a>
  </div>

  <!-- Logout confirmation modal -->
  <div id="logoutModal" class="modal">
    <div class="modal-content">
      <h2 style="color: var(--main-color); margin-bottom: 1rem;">Log Out?</h2>
      <p style="font-size: 1.4rem; margin-bottom: 2rem;">Are you sure you want to log out?</p>
      <button id="confirmLogout">Yes, Log Out</button>
      <button id="cancelLogout">Cancel</button>
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
