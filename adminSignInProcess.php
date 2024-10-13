<?php
require "connection.php"; // Ensure the connection.php file with the Database class is included

// Set up the database connection before using it
Database::setUpConnection(); // Call the method to set up the connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $adminEmail = $_POST["e"];
    $adminPassword = $_POST["p"];

    // Validate inputs
    if (empty($adminEmail)) {
        echo "Please enter your Email";
    } elseif (strlen($adminEmail) > 100) {
        echo "Email must have less than 100 characters";
    } elseif (!filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid Email";
    } elseif (empty($adminPassword)) {
        echo "Please enter your Password";
    } elseif (strlen($adminPassword) < 5 || strlen($adminPassword) > 20) {
        echo "Password must be between 5-20 characters";
    } else {
        // Query the database to check login credentials
        $query = "SELECT * FROM `admin` WHERE `email` = ? AND `password` = ?";
        $params = [$adminEmail, $adminPassword];
        $types = "ss"; // Both email and password are strings

        // Prepare the query using the connection from the Database class
        $stmt = Database::$connection->prepare($query);  
        
        if ($stmt === false) {
            die("Error preparing statement: " . Database::$connection->error);
        }

        // Bind parameters
        $stmt->bind_param($types, ...$params);           
        // Execute the query
        $stmt->execute();                              
        // Get the result of the query
        $result = $stmt->get_result();                  

        if ($result->num_rows == 1) {
            // Success: Redirect to admin dashboard
            header("Location: admin_dashboard.php"); // Redirect to the admin dashboard
            exit();
        } else {
            echo "Invalid Username or Password";
        }
    }
}
