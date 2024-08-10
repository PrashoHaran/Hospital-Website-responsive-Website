<?php

require "connection.php";

$adminEmail = $_POST["e"];
$adminPassword = $_POST["p"];


if (empty($adminEmail)) {
    echo ("Please enter your Email");
} else if (strlen($adminEmail) > 100) {
    echo ("Email must have less than 100 characters");
} else if (!filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email");
} else if (empty($adminPassword )) {
    echo ("Please enter your Password");
} else if (strlen($adminPassword ) < 5 || strlen($adminPassword ) > 20) {
    echo ("Password must have between 5-20 charaters");
} else {

    $rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $adminEmail . "' AND `password`='" . $adminPassword . "'");
    $n = $rs->num_rows;

    if ($n == 1) {

        echo ("success");
      /*  $d = $rs->fetch_assoc();*/
       

    } else {
        echo ("Invalid Username or Password");
    }
}




?>