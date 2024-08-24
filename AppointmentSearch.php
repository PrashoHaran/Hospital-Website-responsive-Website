
<?php

require "connection.php";

$resultset = Database::search("SELECT * FROM `specialization`");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Search</title>
</head>
<body>
    
<div class=" container-fluid">
<div class=" row">

<?php include "header.php"; ?>
<hr class=" my-0">

<!--Select doctor Part -->
<div class="col-6 col-lg-4 mt-4 mb-4 mx-lg-5">

<select name="" id="" class=" form-select">

<option value="" disabled selected>Select Doctor</option>
<option value=""> Janaka</option>

</select>

</div>

<!--Select speciality part -->

<div class="col-6 col-lg-4 mt-4 mb-4">

<select name="" id="" class=" form-select">

<option value="" disabled selected>Select a speciality</option>


<?php 

while ($row = mysqli_fetch_assoc($resultset)) {

?>
<option value=""><?php echo $row['specialization']; ?></option>


<?php

}
?>

</select>

</div>

<!--Searching Item Display part -->

<div class=" col-12 col-lg-12">



</div>




</div>

</div>

</body>
</html>