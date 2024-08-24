<?php
// Include the database connection
require "connection.php";


if (isset($_POST['upload'])) {

  // Retrieve form data
  $card_id = $_POST['card_id'];
  $title = $_POST['title'];
  $text_content = $_POST['text_content'];


  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'images/' . $file_name;

    // Update database and move the file
    Database::iud("UPDATE `cards` SET `title` = '".$title."', `text_content` ='".$text_content."',`image_path` ='".$folder."', `last_updated` = NOW() WHERE `card_id` = '".$card_id."'");

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

//exit();

        

  
   }

   
  


?>
