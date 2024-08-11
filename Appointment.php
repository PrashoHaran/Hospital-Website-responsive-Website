<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>

<div></div>

<div class=" container-fluid">

<div class="row">

<?php include "header.php"; ?>
<hr class=" my-3">

<div class="content-container offset-1">
        <div class="form-container">
            <h1>Book an Appointment</h1>
            <form action="" method="post">
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="doctor">Select Doctor:</label>
                    <select class="form-control" id="doctor" name="doctor" required>
                        <option value="" disabled selected>Select a doctor</option>
                        <option value="dr_ajith">Dr. Ajith Jayasekara</option>
                        <option value="dr_amila">Dr. Amila Rathnapala</option>
                        <option value="dr_ashen">Dr. Ashen Silva</option>
                        <option value="dr_bandara">Dr. B.M.S Bandara</option>
                        <option value="dr_kumara">Dr. D.S Kumara</option>
                        <option value="dr_gaya">Dr. Gaya Bandara</option>
                        <option value="dr_indika">Dr. Indika Jayalath</option>
                        <option value="dr_janith">Dr. Janith Liyanage</option>
                        <option value="dr_rameez">Dr. Rameez Raja</option>
                        <option value="dr_samantha">Dr. Samantha</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="Specialization">Select Specialization:</label>
                    <select class="form-control" id="Specialization" name="Specialize" required>
                        <option value="" disabled selected>Select a speciality</option>
                        <option value="dr_ajith">Ayurvedic</option>
                        <option value="dr_amila">Cardiologist</option>
                        <option value="dr_ashen">Dermatologist</option>
                        <option value="dr_bandara">EYE surgeon</option>
                        <option value="dr_kumara">NEURO surgeon</option>
                        <option value="dr_gaya">Physician</option>
                        <option value="dr_indika">Ongologist</option>
                        <option value="dr_janith">Psychiatrist</option>
                        <option value="dr_rameez">Physiotherapy</option>
                        <option value="dr_samantha">Venereologist</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">Preferred Date:</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- Image container -->
        <div class="image-container">
            <img src="images/Book.jpg" alt="Make Appointment">
        </div>

    </div>

    <hr class=" my-3">
    <?php include "footer.php"; ?>


</div>

</div>

  
    
</body>
</html>
