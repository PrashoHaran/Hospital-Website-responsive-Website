<?php
// File: updateReport.php

// Include the database connection
require_once 'connection.php';

// Initialize variables
$nic = "";
$success = "";
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate NIC
    if (empty($_POST['nic'])) {
        $errors[] = "NIC is required.";
    } else {
        $nic = trim($_POST['nic']);
    }

    // Validate file upload
    if (empty($_FILES['file']['name'])) {
        $errors[] = "File is required.";
    } else {
        $file = $_FILES['file'];
        $upload_dir = 'uploads/';
        $file_path = $upload_dir . basename($file['name']);
        
        // Check if the NIC exists in the database
        $query = "SELECT file_path FROM lab_reports WHERE nic = ?";
        $result = Database::select($query, [$nic], 's');

        if (count($result) > 0) {
            // Delete the old file
            $old_file_path = $result[0]['file_path'];
            if (file_exists($old_file_path)) {
                unlink($old_file_path); // Remove the old file
            }
        } else {
            $errors[] = "NIC not found in the database.";
        }
    }

    // If no errors, proceed with the file upload and database update
    if (empty($errors)) {
        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            // Prepare the SQL query to update the report
            $query = "UPDATE lab_reports SET file_path = ? WHERE nic = ?";
            Database::iud($query, [$file_path, $nic], 'ss');
            $success = "Lab report updated successfully.";
        } else {
            $errors[] = "Failed to upload the file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Lab Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            text-align: left;
        }
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px 15px;
            background-color: #5bc0de;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 3px;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #31b0d5;
        }
        .error, .success {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 3px;
        }
        .error {
            background-color: #f8d7da;
            color: #a94442;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Update Lab Report</h2>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="success">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <form action="updateReport.php" method="POST" enctype="multipart/form-data">
        <label for="nic">NIC:</label>
        <input type="text" name="nic" id="nic" required>

        <label for="file">Upload New File:</label>
        <input type="file" name="file" id="file" required>

        <input type="submit" value="Update Report">
    </form>
</div>

</body>
</html>
