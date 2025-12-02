<?php
include('config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Caffeine Compiler</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="assets/logo.png">
</head>
<body>
  <header class="header">
    <a href="index.php" class="logo">
      <img src="assets/logo1.jpeg" alt="Logo">
    </a>
    <nav class="navbar">
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#menu">Menu</a>
      <a href="#products">Products</a>
      <a href="#review">Review</a>
      <a href="#contact">Contact</a>
      <a href="#blogs">Blogs</a>

      <?php
      if (isset($_SESSION['user'])) {
        echo "<a href='home.php'>Welcome, " . htmlspecialchars($_SESSION['user']) . "</a>";
        echo "<a href='#' id='logout-link'>Logout</a>";
      } else {
        echo "<a href='login.php'>Login</a>";
        echo "<a href='register.php'>Sign Up</a>";
      }
      ?>
    </nav>

    <div class="icons">
      <i class="fa-solid fa-magnifying-glass" id="search-btn"></i>
      <i class="fa-solid fa-cart-shopping" id="cart-btn"></i>
      <i class="fa-solid fa-bars" id="menu-btn"></i>
    </div>

    <div class="search-form">
      <input type="search" id="search-box" placeholder="Search here...">
      <label for="search-box" class="fa-solid fa-magnifying-glass"></label>
    </div>

    <div class="cart-items-container">
      <div class="cart-item">
        <span><i class="fa-solid fa-xmark"></i></span>
        <img src="assets/coffee1.jpeg" alt="">
        <div class="content">
          <h3>Light brown coffee beans</h3>
          <div class="price">₹499</div>
        </div>
      </div>
      <div class="cart-item">
        <span><i class="fa-solid fa-xmark"></i></span>
        <img src="assets/coffee2.jpeg" alt="">
        <div class="content">
          <h3>Dark roasted coffee beans</h3>
          <div class="price">₹499</div>
        </div>
      </div>
      <a href="#" class="btn">Checkout Now</a>
    </div>
  </header>

  <!-- Home -->
  <section class="home" id="home">
    <div class="content">
      <h3>Your Daily Brew, Perfected</h3>
      <p>Awaken your senses — order your favorite cup now!</p>
      <a href="#" class="button">Get yours now!!!</a>
    </div>
  </section>

  <!-- About -->
  <section class="about" id="about">
    <h1 class="heading"><span>About</span> Us</h1>
    <div class="row">
      <div class="image">
        <img src="assets/aboutus.jpeg" alt="">
      </div>
      <div class="content">
        <h3>Why Choose Caffeine Compiler?</h3>
        <p>At Caffeine Compiler, we believe coffee is an art. We source premium beans and roast them to perfection, ensuring each cup delivers rich and smooth flavors crafted by our expert baristas.</p>
        <p>More than just great coffee, we offer a warm and inviting atmosphere designed for connection. Whether you’re meeting friends or enjoying a moment alone, Caffeine Compiler is your cozy retreat from the everyday hustle.</p>
        <a href="#" class="btn">Learn more</a>
      </div>
    </div>
  </section>

  <!-- Menu -->
  <section class="menu" id="menu">
    <h1 class="heading">Our <span>Menu</span></h1>
    <div class="box-container">
      <div class="box">
        <img src="assets/affogato.jpg" alt="">
        <h3>Affogato</h3>
        <div class="price">₹399 <span>₹499</span></div>
        <a href="#" class="btn">Add to cart</a>
      </div>
      <div class="box">
        <img src="assets/americano.jpg" alt="">
        <h3>Americano</h3>
        <div class="price">₹399 <span>₹499</span></div>
        <a href="#" class="btn">Add to cart</a>
      </div>
      <div class="box">
        <img src="assets/latte.jpg" alt="">
        <h3>Latte</h3>
        <div class="price">₹399 <span>₹499</span></div>
        <a href="#" class="btn">Add to cart</a>
      </div>
      <div class="box">
        <img src="assets/coldbrew.jpg" alt="">
        <h3>Cold Brew</h3>
        <div class="price">₹399 <span>₹499</span></div>
        <a href="#" class="btn">Add to cart</a>
      </div>
    </div>
  </section>

  <!-- Products -->
  <section class="products" id="products">
    <h1 class="heading">Our <span>Products</span></h1>
    <div class="box-container">
      <div class="box">
        <div class="images"><img src="assets/coffee1.jpeg" alt=""></div>
        <div class="content">
          <h3>Light brown coffee beans</h3>
          <div class="price">₹499 <span>₹699</span></div>
        </div>
      </div>
      <div class="box">
        <div class="images"><img src="assets/coffee2.jpeg" alt=""></div>
        <div class="content">
          <h3>Dark roasted coffee beans</h3>
          <div class="price">₹499 <span>₹699</span></div>
        </div>
      </div>
      <div class="box">
        <div class="images"><img src="assets/coffee3.jpeg" alt=""></div>
        <div class="content">
          <h3>Green coffee beans</h3>
          <div class="price">₹499 <span>₹699</span></div>
        </div>
      </div>
      <div class="box">
        <div class="images"><img src="assets/coffee4.jpeg" alt=""></div>
        <div class="content">
          <h3>Caramel roast coffee beans</h3>
          <div class="price">₹499 <span>₹699</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Review -->
  <section class="review" id="review">
    <h1 class="heading">Customers' <span>Review</span></h1>
    <div class="box-container">
      <div class="box">
        <i class="fa-solid fa-comments"></i>
        <p>"Caffeine Compiler is my new favorite spot! Cozy ambiance and divine coffee."</p>
        <img src="assets/user3.jpeg" class="user" alt="">
        <h3>Ananya Sharma</h3>
      </div>
      <div class="box">
        <i class="fa-solid fa-comments"></i>
        <p>"If you’re a coffee lover, you have to visit! The pour-over coffee is the best I’ve ever had."</p>
        <img src="assets/user2.jpeg" class="user" alt="">
        <h3>Priya Kapoor</h3>
      </div>
      <div class="box">
        <i class="fa-solid fa-comments"></i>
        <p>"This place is a gem! The espresso is rich and flavorful, and the staff is incredibly friendly."</p>
        <img src="assets/user1.jpeg" class="user" alt="">
        <h3>Rohan Mehta</h3>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section class="contact" id="contact">
    <h1 class="heading">Contact <span>Us</span></h1>
    <div class="row">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14008.112327979654!2d77.20498719714419!3d28.628920445075593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd37b741d057%3A0xcdee88e47393c3f1!2sConnaught%20Place%2C%20New%20Delhi%2C%20Delhi%20110001!5e0!3m2!1sen!2sin!4v1729774070190!5m2!1sen!2sin" 
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" class="map"></iframe>
      <form action="#">
        <h3>Get in Touch</h3>
        <div class="input-box">
          <i class="fa-solid fa-user"></i>
          <input type="text" placeholder="Name">
        </div>
        <div class="input-box">
          <i class="fa-solid fa-envelope"></i>
          <input type="email" placeholder="Email">
        </div>
        <div class="input-box">
          <i class="fa-solid fa-phone"></i>
          <input type="tel" placeholder="Contact number">
        </div>
        <input type="submit" value="Contact Now" class="btn">
      </form>
    </div>
  </section>

  <!-- Blogs -->
  <section class="blogs" id="blogs">
    <h1 class="heading">Our <span>Blogs</span></h1>
    <div class="box-container">
      <div class="box">
        <div class="image"><img src="assets/blog3.jpeg" alt=""></div>
        <div class="content">
          <a href="#" class="title">Top Coffee Trends Today</a>
          <p>From artisanal cold brews to plant-based lattes, explore what’s hot in coffee culture!</p>
        </div>
      </div>
      <div class="box">
        <div class="image"><img src="assets/blog2.jpeg" alt=""></div>
        <div class="content">
          <a href="#" class="title">Caffeine Hacks You’ll Love</a>
          <p>Simple tricks to elevate your coffee experience and home brewing game.</p>
        </div>
      </div>
      <div class="box">
        <div class="image"><img src="assets/blog1.jpeg" alt=""></div>
        <div class="content">
          <a href="#" class="title">Why Coffee Lovers Unite Here</a>
          <p>Where true coffee enthusiasts connect, savor, and celebrate every perfect brew.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <section class="footer">
    <div class="share">
      <i class="fa-brands fa-instagram"></i>
      <i class="fa-brands fa-meta"></i>
      <i class="fa-brands fa-x-twitter"></i>
      <i class="fa-brands fa-linkedin"></i>
      <i class="fa-brands fa-pinterest"></i>
    </div>
    <div class="links">
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#menu">Menu</a>
      <a href="#products">Products</a>
      <a href="#review">Review</a>
      <a href="#contact">Contact</a>
      <a href="#blogs">Blogs</a>
    </div>
    <div class="credits">Created by <span>Gurarpit Singh</span> | all rights reserved</div>
  </section>

  <!-- Logout Modal -->
  <div id="logoutModal" class="modal" style="display:none;">
    <div class="modal-content" style="background:rgba(255,255,255,0.1);backdrop-filter:blur(10px);border-radius:1rem;padding:2rem;text-align:center;color:#fff;width:350px;margin:15% auto;">
      <h2 style="color:var(--main-color);margin-bottom:1rem;">Log Out?</h2>
      <p style="font-size:1.5rem;margin-bottom:2rem;">Are you sure you want to log out?</p>
      <button id="confirmLogout" style="padding:0.8rem 2rem;background:var(--main-color);border:none;border-radius:0.8rem;font-weight:600;cursor:pointer;">Yes, Log Out</button>
      <button id="cancelLogout" style="padding:0.8rem 2rem;background:var(--bg);color:var(--main-color);border:1px solid var(--main-color);border-radius:0.8rem;font-weight:600;cursor:pointer;margin-left:1rem;">Cancel</button>
    </div>
  </div>

  <script src="script.js"></script>
  <script src="https://kit.fontawesome.com/9cc2ce8e91.js" crossorigin="anonymous"></script>
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
