<?php
// Include the database connection
include 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $card_id = $_POST['card_id'];
    $title = $_POST['title'];
    $text_content = $_POST['text_content'];
    $image_path = $_POST['image_path'];

    // Prepare and execute the SQL update statement
    $stmt = $conn->prepare("UPDATE cards SET title = ?, text_content = ?, image_path = ?, last_updated = NOW() WHERE card_id = ?");
    $stmt->bind_param("ssss", $title, $text_content, $image_path, $card_id);

    if ($stmt->execute()) {
        echo "Card updated successfully!";
    } else {
        echo "Error updating card: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit();
}
?>
