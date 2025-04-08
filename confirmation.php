<!-- confirmation.php -->
<?php
session_start();
$user_id = $_SESSION['user_id']; // assuming you're storing logged-in user id in session

// DB connection
$conn = new mysqli("localhost", "root", "", "thali_express");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$address = "Address not found";
if ($stmt = $conn->prepare("SELECT address FROM users WHERE id = ?")) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($address);
    $stmt->fetch();
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Order Confirmation</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="navbar.css" />
  <style>
    .confirmation-container {
      padding: 20px;
      max-width: 600px;
      margin: auto;
    }

    .bill-box {
      background-color: #f9f9f9;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .map-container {
      margin-top: 20px;
    }

    .user-address {
      margin-top: 10px;
      font-weight: bold;
    }

    .static-map {
      width: 100%;
      border-radius: 10px;
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

  <div class="confirmation-container">
    <div class="bill-box">
      <h2>Order Confirmation</h2>
      <p>Your payment was successful. Here is your order summary:</p>
      <div class="bill-details" id="bill-details"></div>

      <div class="map-container">
        <h3>Restaurant Location</h3>
        <img
          class="static-map"
          src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e3/BlankMap-World6.svg/640px-BlankMap-World6.svg.png"
          alt="Restaurant Map Placeholder"
        />
        <div class="user-address">Delivery Address: <?php echo htmlspecialchars($address); ?></div>
      </div>
    </div>
  </div>

  <script>
    const billDetails = document.getElementById("bill-details");
    const order = JSON.parse(localStorage.getItem("order")) || [];
    let total = 0;

    order.forEach(item => {
      total += item.price;
      const itemDetail = document.createElement("p");
      itemDetail.textContent = `${item.name} - ₹${item.price}`;
      billDetails.appendChild(itemDetail);
    });

    const totalDetail = document.createElement("p");
    totalDetail.innerHTML = `<strong>Total: ₹${total}</strong>`;
    billDetails.appendChild(totalDetail);

    // Save order to "orders" in LocalStorage
    const newOrder = {
      id: new Date().getTime(),
      items: order,
      total_price: total,
      status: "Pending"
    };

    let orders = JSON.parse(localStorage.getItem("orders")) || [];
    orders.push(newOrder);
    localStorage.setItem("orders", JSON.stringify(orders));

    // Clear the temporary order
    localStorage.removeItem("order");
  </script>
</body>
</html>
