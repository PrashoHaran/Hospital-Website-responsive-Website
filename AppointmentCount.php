<?php
require "connection.php";

// Check if doctor and date are set in the POST request
if (isset($_POST['doctor']) && isset($_POST['date'])) {
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];

    // Prepare the SQL query to count appointments
    $query = "SELECT COUNT(*) as appointment_count FROM appointment WHERE doctor LIKE '%" . $doctor . "%' AND aDate = '" . $date . "'";

    // Execute the query using the Database::search method
    $result = Database::search($query);

    // Fetch the result and get the appointment count
    if ($row = $result->fetch_assoc()) {
        $appointment_count = $row['appointment_count'];
    } else {
        $appointment_count = 0; // Set count to 0 if no results
    }

    // Return the count as a JSON response
    echo json_encode(['count' => $appointment_count]);
} else {
    // If doctor or date is not set, return count as 0
    echo json_encode(['count' => 0]);
}
?>