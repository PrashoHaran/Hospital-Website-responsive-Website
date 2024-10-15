<?php
require 'fpdf.php';

if (isset($_GET['pName']) && isset($_GET['nic']) && isset($_GET['email']) &&
    isset($_GET['phone']) && isset($_GET['gender']) && isset($_GET['doctor']) &&
    isset($_GET['date']) && isset($_GET['appNum']) && isset($_GET['transaction_id'])) {

    // Retrieve the data
    $pName = $_GET['pName'];
    $nic = $_GET['nic'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
    $gender = $_GET['gender'];
    $doctor = $_GET['doctor'];
    $date = $_GET['date'];
    $appNum = $_GET['appNum'];
    $transaction_id = $_GET['transaction_id'];

    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    $pdf->Cell(0, 10, "Appointment Receipt", 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Patient Name: $pName", 0, 1);
    $pdf->Cell(0, 10, "NIC: $nic", 0, 1);
    $pdf->Cell(0, 10, "Email: $email", 0, 1);
    $pdf->Cell(0, 10, "Phone: $phone", 0, 1);
    $pdf->Cell(0, 10, "Gender: $gender", 0, 1);
    $pdf->Cell(0, 10, "Doctor: $doctor", 0, 1);
    $pdf->Cell(0, 10, "Appointment Date: $date", 0, 1);
    $pdf->Cell(0, 10, "Appointment Number: $appNum", 0, 1);
    $pdf->Cell(0, 10, "Transaction ID: $transaction_id", 0, 1);

    $pdf->Output('D', 'appointment_receipt.pdf');
} else {
    echo "Missing appointment details.";
}
?>
