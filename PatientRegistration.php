<?php
// Include the database connection (adjust based on your setup)
require_once 'connection.php';

// Initialize variables
$patient_id = $name = $nic = $email = $phone = $gender = $marital_status = $date = "";
$errors = [];
$success = "";

// NIC validation function
function validateNic($nic) {
    $old_nic_pattern = '/^[0-9]{9}[vVxX]$/';   // Old NIC format
    $new_nic_pattern = '/^[0-9]{12}$/';        // New NIC format
    return preg_match($old_nic_pattern, $nic) || preg_match($new_nic_pattern, $nic);
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    // Check for required fields depending on the action
    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $nic = isset($_POST['nic']) ? trim($_POST['nic']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : "";
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : "";
    $marital_status = isset($_POST['marital_status']) ? trim($_POST['marital_status']) : "";
    $date = isset($_POST['date']) ? trim($_POST['date']) : "";
    $patient_id = isset($_POST['patient_id']) ? trim($_POST['patient_id']) : "";

    // Validate NIC
    if (empty($nic)) {
        $errors[] = "NIC is required.";
    } elseif (!validateNic($nic)) {
        $errors[] = "Invalid NIC format. Please enter a valid NIC.";
    }

    // Handle Add
    if ($action === 'add') {
        if (empty($errors)) {
            $query = "INSERT INTO patients (name, nic, email, phone, gender, marital_status, date) VALUES (?, ?, ?, ?, ?, ?, ?)";
            Database::iud($query, [$name, $nic, $email, $phone, $gender, $marital_status, $date], 'sssssss');
            $success = "Patient registered successfully.";
        }
    }

    // Handle Update
    if ($action === 'update')  {
        // Check if the patient ID is provided
        if (empty($patient_id)) {
            $errors[] = "Patient ID is required for updating.";
        } else {
            // Check if the patient exists
            $checkQuery = "SELECT * FROM patients WHERE id = ?";
            $result = Database::select($checkQuery, [$patient_id], 'i');
            
            if (empty($result)) {
                $errors[] = "No patient found with the given ID.";
            } else {
                // If no errors, update the patient record
                if (empty($errors)) {
                    $query = "UPDATE patients SET name = ?, nic = ?, email = ?, phone = ?, gender = ?, marital_status = ?, date = ? WHERE id = ?";
                    Database::iud($query, [$name, $nic, $email, $phone, $gender, $marital_status, $date, $patient_id], 'sssssssi');
                    $success = "Patient record updated successfully.";
                }
            }
        }
    }

    // Handle Delete
    if ($action === 'delete') {
        // Check if the patient exists
        if (empty($nic)) {
            $errors[] = "NIC is required for deletion.";
        } else {
            $checkQuery = "SELECT * FROM patients WHERE nic = ?";
            $result = Database::select($checkQuery, [$nic], 's');
            

            if (empty($result)) {
                $errors[] = "No patient found with the given NIC.";
            } else {
                // If the patient exists, proceed with deletion
                $query = "DELETE FROM patients WHERE nic = ?";
                Database::iud($query, [$nic], 's');
                $success = "Patient record deleted successfully.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration Manager</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding: 30px;
        }
        .container {
            max-width: 700px;
            margin: auto;
        }

        .btn {
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }
        .btn-add { background-color: #28a745; }
        .btn-update { background-color: #17a2b8; }
        .btn-delete { background-color: #dc3545; }
        .form-container {
            display: none;
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .error, .success {
            color: white;
            padding: 10px;
            margin-top: 10px;
        }
        .error { background-color: #dc3545; }
        .success { background-color: #28a745; }


       
        .form-image {
            width: 100%; 
            height: auto; 
            max-height: 200px; 
            object-fit: cover; 
            margin-bottom: 15px; 
            border-radius: 10px; 
        }

       
        .required {
            color: red; 
        }

        
        .form-group {
            margin-bottom: 15px; 
        }

        
        label {
            font-weight: bold; 
            display: block; 
            margin-bottom: 5px; 
        }
       
        .form-buttons {
            text-align: center; 
        }

        .form-buttons button {
            min-width: 120px; 
            padding: 10px 15px; 
            margin: 5px; 
            background-color: #007bff; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            transition: background-color 0.3s ease; 
        }

        .form-buttons button:hover {
            background-color: #0056b3;
        }

        
        .radio-group {
            margin-bottom: 15px; 
        }

        
        h3 {
            text-align: center; 
            color: #333; 
        }

    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center mb-4">Patient Registration Manager</h2>
        <div class="text-center">
            <button class="btn btn-add" onclick="showForm('addForm')">Add Patient</button>
            <button class="btn btn-update" onclick="showForm('updateForm')">Update Patient</button>
            <button class="btn btn-delete" onclick="showForm('deleteForm')">Delete Patient</button>
        </div>

        <!-- Error and Success Messages -->
        <?php if (!empty($errors)) { ?>
            <div class="error">
                <?php foreach ($errors as $error) echo $error . '<br>'; ?>
            </div>
        <?php } ?>

        <?php if (!empty($success)) { ?>
            <div class="success"><?php echo $success; ?></div>
        <?php } ?>

        <!-- Add Patient Form -->
        <div id="addForm" class="form-container">
            <h4>Add New Patient</h4>
            <form method="POST" action="PatientRegistration.php">
                <div class="form-group">
                    <label for="name">Patient Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nic">NIC:</label>
                    <input type="text" id="nic" name="nic" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Gender:</label>
                    <div>
                        <label><input type="radio" name="gender" value="male" required> Male</label>
                        <label><input type="radio" name="gender" value="female"> Female</label>
                        <label><input type="radio" name="gender" value="other"> Other</label>
                    </div>

                </div>
                <div class="form-group">
                    <label>Marital Status:</label>
                    <div>
                        <label><input type="radio" name="marital_status" value="single" required> Single</label>
                        <label><input type="radio" name="marital_status" value="married"> Married</label>
                        <label><input type="radio" name="marital_status" value="divorced"> Divorced</label>
                        <label><input type="radio" name="marital_status" value="widowed"> Widowed</label>


                    <div class="row">
                        <div class="col-md-6 radio-group">
                            <label>Gender:<span class="required">*</span></label>
                            <div>
                                <label><input type="radio" name="gender" value="male" required> Male</label>
                                <label><input type="radio" name="gender" value="female"> Female</label>
                                <label><input type="radio" name="gender" value="other"> Other</label>
                            </div>
                        </div>

                        <div class="col-md-6 radio-group">
                            <label>Marital Status:<span class="required">*</span></label>
                            <div>
                                <label><input type="radio" name="marital_status" value="single" required> Single</label>
                                <label><input type="radio" name="marital_status" value="married"> Married</label>
                                <label><input type="radio" name="marital_status" value="divorced"> Divorced</label>
                                <label><input type="radio" name="marital_status" value="widowed"> Widowed</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <input type="hidden" name="action" value="add">
                <button type="submit" class="btn btn-add">Submit</button>
            </form>
        </div>

        <!-- Update Patient Form -->
        <div id="updateForm" class="form-container">
            <h4>Update Patient</h4>
            <form method="POST" action="PatientRegistration.php">
                <div class="form-group">
                    <label for="patient_id">Patient ID:</label>
                    <input type="number" id="patient_id" name="patient_id" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="name">Patient Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nic">NIC:</label>
                    <input type="text" id="nic" name="nic" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Gender:</label>
                    <div>
                        <label><input type="radio" name="gender" value="male" required> Male</label>
                        <label><input type="radio" name="gender" value="female"> Female</label>
                        <label><input type="radio" name="gender" value="other"> Other</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Marital Status:</label>
                    <div>
                        <label><input type="radio" name="marital_status" value="single" required> Single</label>
                        <label><input type="radio" name="marital_status" value="married"> Married</label>
                        <label><input type="radio" name="marital_status" value="divorced"> Divorced</label>
                        <label><input type="radio" name="marital_status" value="widowed"> Widowed</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <input type="hidden" name="action" value="update">
                <button type="submit" class="btn btn-update">Update Patient</button>
            </form>
        </div>

        <!-- Delete Patient Form -->
        <div id="deleteForm" class="form-container">
            <h4>Delete Patient</h4>
            <form method="POST" action="PatientRegistration.php">
                <div class="form-group">
                    <label for="nic">NIC:</label>
                    <input type="text" id="nic" name="nic" class="form-control" required>
                </div>
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="btn btn-delete">Delete Patient</button>
            </form>
        </div>
    </div>

    <script>
        // Function to show the appropriate form
        function showForm(formId) {
            // Hide all forms initially
            document.querySelectorAll('.form-container').forEach(form => {
                form.style.display = 'none';
            });
            // Show the selected form
            document.getElementById(formId).style.display = 'block';
        }
    </script>
</body>

</html>
