<?php 
require 'connection.php';

$resultset = Database::search("SELECT * FROM `specialization`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    
<div class="container-fluid">
    <div class="row">

        <?php include "header.php"; ?>
        <hr class="my-0">

        <div class="col-12 p-0 mx-2 mt-2">
            <div class="col-2">
                <button class="btn btn-dark p-2" onclick="window.location.href='adminHome.php';">  
                    <i class="bi bi-arrow-left-square-fill col-1 mx-1"></i>Back
                </button>
            </div>
        </div>
        <hr class="my-2">

        <div class="col-4 my-2 mt-2 p-1" style="background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%); border-radius: 30px;">
            <form action="addDoctorProcess.php" method="post" class="form-container mx-5" onsubmit="return doctorvalidate()">
                <!-- Doctor Name -->
                <div class="col-12">
                    <label for="dname" class="form-label">Doctor Name</label>
                    <input type="text" class="form-control" name="dname" id="dname" placeholder="Please Enter the Doctor Name" required>
                </div>
                <!-- Doctor NIC -->
                <div class="col-12">
                    <label for="nic" class="form-label">NIC</label>
                    <input type="text" class="form-control" placeholder="Enter NIC" name="nic" id="nic" required>
                </div>
                <!-- Doctor Email -->
                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" placeholder="Please Enter the Email" class="form-control" required>
                </div>
                <!-- Doctor Speciality -->
                <div class="col-12">
                    <label for="speciality" class="form-label my-0">Select Speciality</label>
                    <select name="speciality" id="speciality" class="form-select mt-0 my-2" required>
                        <option value="" disabled selected>Select Speciality</option>
                        <?php while ($row = mysqli_fetch_assoc($resultset)) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['specialization']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button class="btn btn-dark" name="submit" type="submit">Submit</button>
            </form>
        </div>
        <?php include "footer.php"; ?>
    </div>
</div>
<<<<<<< HEAD
 

</div>
<hr class=" my-2">

<!--Doctor Form -->

<div class=" col-2 col-lg-4">


</div>


<div class="col-4 my-2 mt-2 p-1" style=" background: rgb(238,174,202);
background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%); border-radius: 30px;">

<form action="addDoctorProcess.php" method="post" class=" form-container mx-5" onsubmit="return doctorvalidate()">
<!--Doctor Name -->
<div class="col-12 ">
    <label for="dname" class=" form-label">Doctor Name</label>
    <input type="text" class=" form-control" name="dname" id="dname" placeholder="Please Enter the Doctor Name" required>
</div>
<!--Doctor NIC -->
<div class=" col-12">
<label for="nic" class=" form-label">NIC</label>
<input type="text" class=" form-control" placeholder="Enter NIC" name="nic" id="nic" >
</div>
<!--Doctor Email -->
<div class=" col-12">
<label for="email" class=" form-label">Email</label>
<input type="text" name="email" id="email" placeholder=" Please Enter the Email" class=" form-control" required>
</div>



<!--Doctor Speciality -->
<div class=" col-12">
<label for="speciality" class=" form-label my-0">Select Speciality</label>
<select name="speciality" id="speciality" class=" form-select mt-0 my-2">

<option value="" disabled selected>Select Speciality</option>


<?php 

while ($row = mysqli_fetch_assoc($resultset)) {

?>
<option value=""><?php echo $row['specialization']; ?></option>


<?php

}
?>

</select>

</div>
<div class=" col-12 ">
<button class="btn btn-dark" name="submit" type="submit" onclick="doctorvalidate();">Submit</button>

</div>

</form>

</div>


<?php include "footer.php"; ?>
</div>
</div>

=======
>>>>>>> a9bb39bc7e5a10ab2a2d121a0b0074336e83594e

<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
