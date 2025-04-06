<?php
$username = "root"; // Change if you have a different MySQL username
$password = ""; // Change if you have a password
$servername = "localhost"; // Change if needed
$dbname = "thali_express";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection

if(!$conn){
    die("Connection failed: " . $conn->connect_error);
}
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    // Insert into contact_us table
    $stmt = $conn->prepare("INSERT INTO contact_us (fullname, phone, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $phone, $email);

    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!'); window.location.href='contact_us.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
$stmt->close();
$conn->close();
// Close connection

?>