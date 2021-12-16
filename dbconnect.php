<?php


function db_connect(){
    static $connection;
    if(!isset($connection)){
        //$config_file = "./config/config.ini";
        //$config = parse_ini_file($config_file);
        $host = "localhost";
        $dbuser = "root";
        $dbpass = "root";
        $database = "femdevblog";
        $connection = mysqli_connect($host, $dbuser, $dbpass, $database);
    }
    
    if(!$connection){
        echo "Failed to connect: " . mysqli_connect_error();
    }
    return $connection;
}

function db_connect2(){
    static $connection;
    if(!isset($connection)){
        //$config_file = "./config/config.ini";
        //$config = parse_ini_file($config_file);
        $host = "localhost";
        $dbuser = "root";
        $dbpass = "root";
        $database = "femdevblog";
        $connection = mysqli_connect($host, $dbuser, $dbpass, $database);
    }
    
    if(!$connection){
        echo "Failed to connect: " . mysqli_connect_error();
    }
    return $connection;
}
      
?>