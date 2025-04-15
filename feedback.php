<?php
    $username = "root";
    $password = "";
    $host = "localhost";
    $dbname = "thali_express";

    // Create connection
    $conn = new mysqli($host, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create Database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {
        // Select the database
        $conn->select_db($dbname);

        // Create Feedback Table if it doesn't exist
        $sql = "CREATE TABLE IF NOT EXISTS feedback (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            rating INT NOT NULL,
            comments TEXT,
            visit_again VARCHAR(10),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if ($conn->query($sql) === TRUE) {
            // Table created successfully
        } else {
            die("Error creating table: " . $conn->error);
        }
    } else {
        die("Error creating database: " . $conn->error);
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $rating = $_POST["rating"];
        $comments = $_POST["comments"];
        $visit_again = $_POST["visit_again"];

        $stmt = $conn->prepare("INSERT INTO feedback (name, email, rating, comments, visit_again) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $name, $email, $rating, $comments, $visit_again);

        if ($stmt->execute()) {
            echo "<script>
                alert('Thank you for your feedback!');
                window.location.href = 'menu.php';
            </script>";
        } else {
            echo "<script>alert('Error submitting feedback. Please try again.');</script>";
        }

        $stmt->close();
    }

    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - The Thali Express</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        
        .feedback-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        h2 {
            text-align: center;
            color: #333;
        }
        
        .feedback-form {
            display: flex;
            flex-direction: column;
        }
        
        label {
            margin-top: 10px;
            font-weight: bold;
        }
        
        input, textarea, select {
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 5px;
        }
        
        button:hover {
            background-color: #45a049;
        }
        
        .rating {
            display: flex;
            justify-content: space-between;
            margin: 15px 0;
        }
        #later-btn{
            background-color: #f44336;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="feedback-container">
        <h2>Your Feedback</h2>
        <form class="feedback-form" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label>How was your experience?</label>
            <div class="rating">
                <label><input type="radio" name="rating" value="5" required> Excellent</label>
                <label><input type="radio" name="rating" value="4"> Good</label>
                <label><input type="radio" name="rating" value="3"> Average</label>
                <label><input type="radio" name="rating" value="2"> Poor</label>
                <label><input type="radio" name="rating" value="1"> Bad</label>
            </div>
            
            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments" rows="4"></textarea>
            
            <label for="visit-again">Would you visit again?</label>
            <select id="visit-again" name="visit_again">
                <option value="yes">Yes</option>
                <option value="maybe">Maybe</option>
                <option value="no">No</option>
            </select>
            
            <button type="submit">Submit Feedback</button>
            <button type="submit" id="later-btn" onclick=redirect();>I'll fill later</button>
        </form>
    </div>
    <script>
        function redirect(){
            window.location.href = "menu.php";
        }
    </script>
</body>
</html>