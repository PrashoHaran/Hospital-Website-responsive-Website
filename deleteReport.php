<?php
// File: deleteReport.php

// Include the database connection
require_once 'connection.php';

// Initialize variables
$nic = "";
$errors = [];
$success = "";

// NIC validation function
function validateNic($nic) {
    $old_nic_pattern = '/^[0-9]{9}[vVxX]$/';
    $new_nic_pattern = '/^[0-9]{12}$/';
    return preg_match($old_nic_pattern, $nic) || preg_match($new_nic_pattern, $nic);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['nic'])) {
        $errors[] = "NIC is required.";
    } else {
        $nic = trim($_POST['nic']);
        if (!validateNic($nic)) {
            $errors[] = "Invalid NIC format.";
        }
    }

    if (empty($errors)) {
        // Check if the NIC exists in the database
        $query = "SELECT file_path FROM lab_reports WHERE nic = ?";
        $result = Database::select($query, [$nic], 's');

        if (count($result) > 0) {
            // Delete the file from the filesystem
            $file_path = $result[0]['file_path'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            // Prepare the SQL query to delete the record from the database
            $query = "DELETE FROM lab_reports WHERE nic = ?";
            Database::iud($query, [$nic], 's'); // 's' = string parameter
            $success = "Lab report and associated file deleted successfully.";
        } else {
            $errors[] = "No report found for the given NIC.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Lab Report</title>
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
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px 15px;
            background-color: #d9534f;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 3px;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #c9302c;
        }
        .error, .success {
            padding: 10px;
            margin-bottom: 15px
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
    <h2>Delete Lab Report</h2>

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

    <form action="deleteReport.php" method="POST">
        <label for="nic">NIC:</label>
        <input type="text" name="nic" id="nic" value="<?php echo htmlspecialchars($nic); ?>" required>

        <input type="submit" value="Delete Report">
    </form>
</div>

</body>
</html>
