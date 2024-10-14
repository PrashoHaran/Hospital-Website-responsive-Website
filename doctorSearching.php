<?php
require "connection.php";

if (isset($_POST['special_id'])) {
    $special_id = $_POST['special_id'];

    // Fetch doctors based on the selected specialization id
   
    
$result = Database::search("SELECT d.dName FROM doctor d INNER JOIN specialization s ON d.special_id = s.id WHERE s.id = '".$special_id."'");

if($result->num_rows > 0){

    while ($row = mysqli_fetch_assoc($result)) {

        echo '<option value="'.$row['dName'].'">Dr.'.$row['dName'].'</option>';
        
        }
}
else{
    echo '<option value="" disabled>No Doctors Available</option>';

}

 
 
}

if (isset($_POST['special_id2'])) {
    $special_id2 = $_POST['special_id2'];

    // Fetch doctors based on the selected specialization id
   
    
$result2 = Database::search("SELECT d.dName FROM doctor d INNER JOIN specialization s ON d.special_id = s.id WHERE s.id = '".$special_id2."'");

if($result2->num_rows > 0){

    while ($row = mysqli_fetch_assoc($result2)) {

        echo '<option value="'.$row['dName'].'">Dr.'.$row['dName'].'</option>';
        
        }
}
else{
    echo '<option value="" disabled>No Doctors Available</option>';

}

 
 
}

?>
