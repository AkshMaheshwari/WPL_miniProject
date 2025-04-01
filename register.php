<?php
$conn = new mysqli("localhost", "root", "", "thali_express");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

    // Check if email already exists
    $check_user = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_user->bind_param("s", $email);
    $check_user->execute();
    $check_user->store_result();

    if ($check_user->num_rows > 0) {
        echo "<script>alert('Email already registered!'); window.location.href='register.html';</script>";
        exit();
    }

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (fullname, phone, email, address, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fullname, $phone, $email, $address, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! Please login.'); window.location.href='login.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>