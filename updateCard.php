<?php
// Include the database connection
require "connection.php";

if (isset($_POST['upload'])) {

    // Retrieve form data
    $card_id = $_POST['card_id'];
    $title = $_POST['title'];
    $text_content = $_POST['text_content'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        // File details
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $folder = 'images/' . $file_name;

        // Prepare the query with placeholders
        $query = "UPDATE `cards` SET `title` = ?, `text_content` = ?, `image_path` = ?, `last_updated` = NOW() WHERE `card_id` = ?";

        // Parameters to bind (use array format)
        $params = [$title, $text_content, $folder, $card_id];

        // Types of the parameters ('s' for string, 'i' for integer)
        $types = "sssi"; // 'sssi' stands for 3 strings (s) and 1 integer (i)

        // Call the iud function with the correct arguments
        Database::iud($query, $params, $types);

        // Move uploaded file
        if (move_uploaded_file($tempname, $folder)) {
            echo "<script>alert('Success');</script>";
            header("Location: updateForm.php");
        } else {
            echo "<script>alert('Not Success');</script>";
            header("Location: updateForm.php");
        }

    } else {
        echo "<script>alert('No file uploaded or there was an error with the upload.');</script>";
    }
}

?>
