<?php
// appointmentRecite.php

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Debugging: Check what data is being passed
echo "<pre>";
print_r($_GET);
echo "</pre>";

// Check if the necessary data is available
if (isset($_GET["pName"]) && isset($_GET["nic"]) && isset($_GET["email"]) &&
    isset($_GET["phone"]) && isset($_GET["gender"]) && isset($_GET["doctor"]) &&
    isset($_GET["date"]) && isset($_GET["appNum"]) && isset($_GET["transaction_id"])) {

    // Retrieve the data
    $pName = $_GET["pName"];
    $nic = $_GET['nic'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
    $gender = $_GET['gender'];
    $doctor = $_GET['doctor'];
    $date = $_GET['date'];
    $appNum = $_GET['appNum'];
    $transaction_id = $_GET["transaction_id"];

    // Display the receipt
    echo "<h1>Appointment Receipt</h1>";
    echo "<p><strong>Patient Name:</strong> $pName</p>";
    echo "<p><strong>NIC:</strong> $nic</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Phone:</strong> $phone</p>";
    echo "<p><strong>Gender:</strong> $gender</p>";
    echo "<p><strong>Doctor:</strong> $doctor</p>";
    echo "<p><strong>Appointment Date:</strong> $date</p>";
    echo "<p><strong>Appointment Number:</strong> $appNum</p>";
    echo "<p><strong>Transaction ID:</strong> $transaction_id</p>";

    // Provide a link to download the receipt as a PDF
    echo "<a href='generatePDF.php?pName=" . urlencode($pName) .
         "&nic=" . urlencode($nic) .
         "&email=" . urlencode($email) .
         "&phone=" . urlencode($phone) .
         "&gender=" . urlencode($gender) .
         "&doctor=" . urlencode($doctor) .
         "&date=" . urlencode($date) .
         "&appNum=" . urlencode($appNum) .
         "&transaction_id=" . urlencode($transaction_id) .
         "' target='_blank'>Download Receipt as PDF</a>";
} else {
    echo "Missing appointment details.";
}
?>
