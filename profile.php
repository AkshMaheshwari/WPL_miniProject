<?php
session_start();
$conn = new mysqli("localhost", "root", "", "thali_express");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION["user_id"];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    
    $stmt = $conn->prepare("UPDATE users SET fullname=?, phone=?, email=?, address=? WHERE id=?");
    $stmt->bind_param("ssssi", $fullname, $phone, $email, $address, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION["fullname"] = $fullname;
        $_SESSION["phone"] = $phone;
        $_SESSION["address"] = $address;
        $message = "Profile updated successfully!";
    } else {
        $message = "Error updating profile.";
    }
}

$stmt = $conn->prepare("SELECT fullname, phone, email, address FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($fullname, $phone, $email, $address);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - The Thali Express</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="navbar.css"> 
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
          <li class="navbar__item">
            <a href="logout.php" class="navbar__link"><i data-feather="Logout"></i><span>Logout</span></a>        
          </li>
        </ul>
      </nav>

    <section class="profile-container">
        <div class="profile-box">
            <h1>Profile</h1>
            <p><?php echo $message; ?></p>
            <form action="profile.php" method="POST">
                <label>Full Name:</label>
                <input type="text" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" required>
                
                <label>Phone Number:</label>
                <input type="tel" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
                
                <label>Email Address:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required readonly>
                
                <label>Address:</label>
                <textarea name="address" required><?php echo htmlspecialchars($address); ?></textarea>
                
                <button type="submit">Update Profile</button>
            </form>
             
        </div>
    </section>

</body>
</html>
