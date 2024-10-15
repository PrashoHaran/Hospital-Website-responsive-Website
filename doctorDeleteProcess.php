<?php

require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nic = $_POST["nic"];

    $query = "DELETE FROM doctor WHERE nic = ?";

    Database::iud($query, [$nic], "s");

    echo "success";
    
}

?>