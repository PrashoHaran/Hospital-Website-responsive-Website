<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
</head>

<body>

    <div class=" container-fluid">
        <div class=" row">

            <?php include "header.php"; ?>
            <hr class=" my-0">

            <div class="col-12 col-lg-12 pt-1 px-0 text-light mx-0 p-0" style="background-color: #12492f;">

                <button class=" col-2 btn btn-light text-light btn-btn-outline-light my-2" style="background:  linear-gradient(90deg, rgba(25,158,9,1) 0%, rgba(13,37,14,1) 50%, rgba(22,170,13,1) 100%);" onclick="changeView1();">Appointment Details</button>
                <button class=" col-2 btn btn-light text-light btn-btn-outline-light my-2" style="background:  linear-gradient(90deg, rgba(25,158,9,1) 0%, rgba(13,37,14,1) 50%, rgba(22,170,13,1) 100%);" onclick="changeView2();">Latest News Update</button>
                <button class=" col-2 btn btn-light text-light btn-btn-outline-light my-2" style="background:  linear-gradient(90deg, rgba(25,158,9,1) 0%, rgba(13,37,14,1) 50%, rgba(22,170,13,1) 100%);" onclick="window.location.href='addDoctor.php';">Add Doctor</button>
                <button class=" col-2 btn btn-light text-light btn-btn-outline-light my-2" style="background:  linear-gradient(90deg, rgba(25,158,9,1) 0%, rgba(13,37,14,1) 50%, rgba(22,170,13,1) 100%);" onclick="window.location.href='addLabReport.php';">Add Lab Report</button>
                <button class=" col-2 btn btn-light text-light btn-btn-outline-light my-2" style="background:  linear-gradient(90deg, rgba(25,158,9,1) 0%, rgba(13,37,14,1) 50%, rgba(22,170,13,1) 100%);" onclick="window.location.href='PatientRegistration.php';">Add Patient Button</button>
            </div>

            <!-- Appointment Details page import to admin home page-->

            <div class="col-12 col-lg-12" id="appointmentBox">
                <?php include "appointmentDetails.php"; ?>

               
            </div>

            <!--Latest News update form -->

            <div class="col-12 col-lg-12 d-none " style="background-color: #eee;" id="newsBox">

         

                <?php include "updateForm.php" ?>

            </div>





            <?php include "footer.php"; ?>
       

        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>