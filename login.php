<?php
// login.php
session_start();
require_once 'connection.php';

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Initialize variables
$email = $password = "";
$email_err = $password_err = $general_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($email)) {
        $email_err = "Please enter your email.";
    }

    if (empty($password)) {
        $password_err = "Please enter your password.";
    }

    // If no errors, proceed to authenticate
    if (empty($email_err) && empty($password_err)) {
        // Retrieve user data
        $result = Database::search("SELECT id, password FROM users WHERE email = '$email'");
        if ($result->num_rows == 0) {
            $email_err = "No user found with this email. <a href='register.php'>Register here</a>.";
        } else {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Successful login
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                header("Location: payment.php");
                exit();
            } else {
                $password_err = "Incorrect password.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hospital Payment</title>
    <style>
        /* Inline CSS for simplicity */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 400px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container label {
            display: block;
            margin-top: 10px;
        }

        .container input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        .error {
            color: red;
            font-size: 0.9em;
        }

        .container button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        .container button:hover {
            background-color: #0056b3;
        }

        .container p {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php
            if (!empty($general_err)) {
                echo "<p class='error'>$general_err</p>";
            }
        ?>
        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <span class="error"><?php echo $email_err; ?></span>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <span class="error"><?php echo $password_err; ?></span>

            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>
</html>
