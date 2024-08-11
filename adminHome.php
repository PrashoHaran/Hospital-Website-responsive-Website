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

            <div class="col-2 col-lg-2 pt-5 px-3 text-light mx-0" style="background-color: #12492f; height: 100vh;">

                <button class=" col-12 btn btn-light text-light btn-btn-outline-light my-2" style="background:  linear-gradient(90deg, rgba(25,158,9,1) 0%, rgba(13,37,14,1) 50%, rgba(22,170,13,1) 100%);" onclick="changeView1();">Appointment Details</button>
                <button class=" col-12 btn btn-light text-light btn-btn-outline-light my-2" style="background:  linear-gradient(90deg, rgba(25,158,9,1) 0%, rgba(13,37,14,1) 50%, rgba(22,170,13,1) 100%);" onclick="changeView2();">Latest News Update</button>

            </div>

            <!-- Appointment Details page import to admin home page-->

            <div class="col-10 col-lg-10 " id="appointmentBox">
                <?php include "appointmentDetails.php"; ?>


            </div>

            <!--Latest News update form -->

            <div class="col-10 col-lg-10 d-none " style="background-color: #eee; height:20vh" id="newsBox">

<!-- menna me div eka athule latest news update tika hdnna -->

            </div>






            <?php include "footer.php"; ?>

        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>