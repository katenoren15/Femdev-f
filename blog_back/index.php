<?php
session_start();

@$page = $_GET["page"];

include ('header.php');
switch (@$page){
    case "":
        include("main.php");
        break;
    case "posts":
        include("main.php");
        break;
    case "categories":
        include ("categories.php");
        break;
    case "users":
        include ("users.php");
        break;
}   


//include ('../includes/footer.php');
?>