<?php

require "connection.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


</head>

<body>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12 col-lg-12 mx-0 p-0" style="background-color:  #eee;">

                <div class="col-12 col-lg-12 mx-0 p-0 text-center text-white mt-2 my-2 p-3" style="background:  linear-gradient(90deg, rgba(25,158,9,1) 0%, rgba(13,37,14,1) 50%, rgba(22,170,13,1) 100%)">

                    <span class=" fs-3">Patient Appointment Details</span>

                </div>

                <div class="col-12 col-lg-12 text-center">

                    <div class="row">

                        <div class="col-12 col-lg-12">

                        <form action="" class=" form-control" method="POST">
                            <div class="row">

                                <div class="col-4">
                                    <input type="text" class=" form-control" placeholder="Doctor name" id="dName" name="dname">

                                </div>

                                <div class="col-4">
                                    <input type="date" class=" form-control" id="date" name="date">
                                </div>

                                <div class="col-2 col-lg-1">
                                    <button class=" form-control" name="submit"><i class="bi bi-search"></i></button>
                                </div>

                               
                            </div>
                            </form>
                        </div>
<?php 


if(isset($_POST['submit'])){

    $dName = $_POST['dname'];
    $date = $_POST['date'];
    
    if($dName ==="" || $date ===""){
        $resultset = Database::search("SELECT * FROM `appointment`");

    }
    else
    {
        $resultset = Database::search("SELECT * FROM `appointment` WHERE `doctor` LIKE '%".$dName."%' AND `date`='".$date."'");
    }
   
        }
   if(!isset($_POST['submit'])){

    $resultset = Database::search("SELECT * FROM `appointment`");

   }     
       

?>

                        <div class="col-12 col-lg-6">



                        </div>

                    </div>

                </div>


                <div class="col-12 col-lg-12 mx-0 p-0">


                    <!--Patient Appointment Details-->

                    <table class="table table-bordered table-hover mt-2 text-center">

                        <thead>
                            <tr class=" table-success">
                                <th scope="col">Email Address</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Doctor</th>
                                <th scope="col">Appointment Number</th>
                                <th scope="col">Appointment Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php

                                while ($row = mysqli_fetch_assoc($resultset)) {
                                ?>
                                    <td> <?php echo $row['email']; ?></td>
                                    <td> <?php echo $row['pName']; ?></td>
                                    <td> Dr.<?php echo $row['doctor']; ?></td>
                                    <td> <?php echo $row['appNum']; ?></td>
                                    <td> <?php echo $row['date']; ?></td>

                            </tr>
                        <?php
                                }
                        ?>



                    </table>



                </div>

            </div>

        </div>

    </div>


    <script src="script.js"></script>
</body>

</html>