<?php

require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

$dName = $_POST["dName"];
$nic = $_POST["nic"];
$email = $_POST["email"];
$speciality = $_POST["speciality"];

/*
echo $dName;
echo $nic;
echo $email;
echo $speciality;
*/
$query = "UPDATE doctor SET dName = ?, dEmail = ?, special_id = ? WHERE nic = ?";

try {
   
    Database::iud($query, [$dName, $email, $speciality, $nic], "ssis");

    echo "success";


} catch (Exception $e) {
    echo "Error updating doctor details: " . $e->getMessage();
}


}





?>