<?php
session_start();
$conn = new mysqli("localhost", "root", "", "thali_express");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, fullname, phone, address, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $fullname, $phone, $address, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["fullname"] = $fullname;
            $_SESSION["phone"] = $phone;
            $_SESSION["address"] = $address;
            header("Location: menu.html");
            exit();
        } else {
            echo "<script>alert('Invalid password!'); window.location.href='index.html';</script>";
        }
    } else {
        echo "<script>alert('User not found! Please register first.'); window.location.href='register.html';</script>";
    }
}
?>