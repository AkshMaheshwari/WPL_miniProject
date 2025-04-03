<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - The Thali Express</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        .user-greeting {
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    color: #fff;
    background: linear-gradient(to right, #ff4e50, #fc913a);
    padding: 15px;
    border-radius: 10px;
    margin: 20px auto;
    width: 80%;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
}
    </style>
</head>
<body>
        
    
    <!-- Navbar -->
    <nav class="navbar">
        <ul class="navbar__menu">
          <li class="navbar__item">
            <a href="menu.php" class="navbar__link"><i data-feather="Menu"></i><span>Menu</span> </a>
          </li>
          <li class="navbar__item">
            <a href="membership.html" class="navbar__link"><i data-feather="Membership"></i><span>Membership</span></a>        
          </li>
          <li class="navbar__item">
            <a href="cart.html" class="navbar__link"><i data-feather="Cart"></i><span>Cart</span></a>        
          </li>
          <li class="navbar__item">
            <a href="contact_us.html" class="navbar__link"><i data-feather="Contact Us"></i><span>Contact Us</span></a>        
          </li>
          <li class="navbar__item">
            <a href="profile.php" class="navbar__link"><i data-feather="Profile"></i><span>Profile</span></a>        
          </li>
          <li class="navbar__item">
            <a href="orders.html" class="navbar__link"><i data-feather="Current Orders"></i><span>Current Orders</span></a>        
          </li>
          

        </ul>
      </nav>

      <!-- User Greeting -->
    <div class="user-greeting">
        <?php 
            if (isset($_SESSION['fullname'])) {
                echo "Hello " . htmlspecialchars($_SESSION['fullname']) . ", What's on your plate today?";
            } else {
                echo "Hello User, What's on your plate today?";
            }
        ?>
    </div>

    <!-- Menu Section -->
    <section class="menu-container">
        <h2 style="text-align: center;">The Veg Specials</h2>
        <div class="menu-grid">
            <div class="menu-item">
                <img src="images/aloo_paratha.jpeg" alt="Aloo Paratha">
                <h4>Aloo Paratha</h4>
                <p>₹199 ⭐⭐⭐⭐</p>
                <button class="add-to-cart" data-name="Aloo Paratha" data-price="199" data-image="images/aloo_paratha.jpeg">
                    Add to Cart
                </button>
            </div>

            <div class="menu-item">
                <img src="images/paneer_tikka.jpeg" alt="Paneer Tikka">
                <h4>Paneer Tikka</h4>
                <p>₹219 ⭐⭐⭐⭐</p>
                <button class="add-to-cart" data-name="Paneer Tikka" data-price="219" data-image="images/paneer_tikka.jpeg">
                    Add to Cart
                </button>
            </div>

            <div class="menu-item">
                <img src="images/veg_cutlet.jpeg" alt="Veg Cutlet">
                <h4>Veg Cutlet</h4>
                <p>₹249 ⭐⭐⭐⭐</p>
                <button class="add-to-cart" data-name="Veg Cutlet" data-price="249" data-image="images/veg_cutlet.jpeg">
                    Add to Cart
                </button>
            </div>
        </div>

        <h2 style="text-align: center;">The Non-Veg Specials</h2>
        <div class="menu-grid">
            <div class="menu-item">
                <img src="images/chicken_tikka.jpeg" alt="Chicken Tikka">
                <h4>Chicken Tikka</h4>
                <p>₹229 ⭐⭐⭐⭐</p>
                <button class="add-to-cart" data-name="Chicken Tikka" data-price="229" data-image="images/chicken_tikka.jpeg">
                    Add to Cart
                </button>
            </div>

            <div class="menu-item">
                <img src="images/reshmi_kebab.jpeg" alt="Reshmi Kebab">
                <h4>Reshmi Kebab</h4>
                <p>₹279 ⭐⭐⭐⭐</p>
                <button class="add-to-cart" data-name="Reshmi Kebab" data-price="279" data-image="images/reshmi_kebab.jpeg">
                    Add to Cart
                </button>
            </div>

            <div class="menu-item">
                <img src="images/murgh_makhni.jpeg" alt="Murgh Makhni">
                <h4>Murgh Makhni</h4>
                <p>₹249 ⭐⭐⭐⭐</p>
                <button class="add-to-cart" data-name="Murgh Makhni" data-price="249" data-image="images/murgh_makhni.jpeg">
                    Add to Cart
                </button>
            </div>
        </div>
         <h2 style="text-align: center;">The Thali Specials</h2>
         <div class="menu-grid">
            <div class="menu-item">
            <img src="images/bahubali_thali.jpg" alt="bahubali_thali">
            <h4>Bhahubali Thali</h4>
            <p>₹389 ⭐⭐⭐⭐</p>
            <button class="add-to-cart" data-name="Bahubali thali" data-price="389" data-image="images/bahubali_thali.jpg">
                    Add to Cart
            </button>
        </div>
            <div class="menu-item">
                <img src="images/goan_thali.jpeg" alt="goan_thali">
                <h4>Goan thali</h4>
                <p>₹399 ⭐⭐⭐⭐</p>
                <button class="add-to-cart" data-name="goan_thali" data-price="399" data-image="images/goan_thali.jpeg">
                    Add to Cart
                </button>
            </div>
            <div class="menu-item">
                <img src="images/maharaja_thali.jpeg" alt="maharaja_thali">
                <h4>Maharaja Thali</h4>
                <p>₹499 ⭐⭐⭐⭐</p>
                <button class="add-to-cart" data-name="maharaja_thali" data-price="499" data-image="images/maharaja_thali.jpeg">
                    Add to Cart
                </button>
            </div>
        </div>
    </section>

    <script src="cart.js"></script>
</body>
</html>
