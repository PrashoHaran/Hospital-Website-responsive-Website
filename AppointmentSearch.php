<?php

require "connection.php";

$resultset1 = Database::search("SELECT * FROM `specialization`");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Search</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>
            <hr class="my-0">
<div class=" col-12 ">

<div class="row px-lg-5" style="background-image: linear-gradient(to right top, #010e01, #0c260d, #0c3e12, #0c5712, #0d720c);">

 <!-- Select Speciality Part -->
 <div class=" col-6 col-lg-4 mt-0 mx-lg-5 px-lg-5">

          <select name="speciality" id="speciality" class="form-select">
                    <option value="" disabled selected>Select a speciality</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($resultset1)) {
                    ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['specialization']; ?></option>
                    <?php
                    }
                    ?>
                </select>
          </div>

            <!-- Select Doctor Part -->
            <div class="col-6 col-lg-4 mt-5 px-lg-5">
                <select name="doctor" id="doctor" class="form-select">
                    <option value="" disabled selected>Select Doctor</option>
                </select>
            </div>

</div>
  

</div>
         
            <!-- Searching Item Display Part -->
            <div class="col-12 col-lg-12">
                <!-- Add any additional content here -->
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            // When the specialization dropdown value changes
            $('#speciality').change(function() {
                var special_id = $(this).val(); // Get the selected specialization ID

                // Send AJAX request to fetch doctors based on specialization
                $.ajax({
                    url: "doctorSearching.php", // PHP file to fetch doctors
                    method: "POST",
                    data: {special_id: special_id}, // Send selected specialization ID
                    success: function(data) {
                        $('#doctor').html(data); // Populate the doctor dropdown with the result
                    }
                });
            });
        });
    </script>

</body>

</html>
