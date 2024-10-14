<?php
// payment_history.php
session_start();
require_once 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch payment history
$payments = [];
try {
    $query = "SELECT payment_method, amount, transaction_id, status, created_at FROM payments WHERE user_id = $user_id ORDER BY created_at DESC";
    $result = Database::search($query);

    if ($result->num_rows > 0) {
        while ($payment = $result->fetch_assoc()) {
            $payments[] = $payment;
        }
    }
} catch (Exception $e) {
    die("Error fetching payment history: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History - Hospital Payment</title>
    <style>
        /* Inline CSS for simplicity */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 800px;
            margin: 30px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .container a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
        }

        .container a:hover {
            text-decoration: underline;
        }

        .logout-link {
            text-align: center;
            margin-top: 15px;
        }

        .logout-link a {
            color: #dc3545;
            text-decoration: none;
        }

        .logout-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Payment History</h2>

        <?php if (empty($payments)): ?>
            <p>You have no payment records.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Payment Method</th>
                    <th>Amount ($)</th>
                    <th>Transaction ID</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
                <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($payment['payment_method']); ?></td>
                        <td><?php echo htmlspecialchars(number_format($payment['amount'], 2)); ?></td>
                        <td><?php echo htmlspecialchars($payment['transaction_id']); ?></td>
                        <td><?php echo htmlspecialchars($payment['status']); ?></td>
                        <td><?php echo htmlspecialchars($payment['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <div style="text-align: center;">
            <a href="payment.php">Make Another Payment</a>
        </div>

        <div class="logout-link">
            <p><a href="logout.php">Logout</a></p>
        </div>
    </div>
</body>
</html>
