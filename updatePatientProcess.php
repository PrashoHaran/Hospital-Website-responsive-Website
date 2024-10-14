<?php
require 'connection.php'; 

// Get form data
$nic = $_POST['nic'];
$name = $_POST['name'];

try {
    $query = "UPDATE patient SET pName = ? WHERE nic = ?";

    Database::iud($query, [$name, $nic], "ss");

    // Return success message
    echo json_encode(["status" => "success", "message" => "Patient details updated successfully."]);
} catch (Exception $e) {

    // Return error message
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}


?>
