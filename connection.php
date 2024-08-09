<?php

class Database{


    public static $connection;

    public static function setUpConnection(){
    
    if(!isset(Database::$connection)){
    
    Database::$connection =  new mysqli("127.0.0.1","root","","database name","3306");
    
    }
}




}



?>