<?php
session_start();

@$page = $_GET["page"];

include ('includes/header.php');
switch (@$page){
    case "":
        include("home.html");
        break;
    case "home":
        include("home.html");
        break;
    case "about-us":
        include ("about.html");
        break;
    case "capacity-building":
        include ("capacityBuilding.html");
        break;
    case "projects-and-needs":
        include ("projectsAndNeeds.html");
        break;
    case "success-stories":
        include ("successstories.html");
        break;
    case "gallery":
        include ("gallery.php");
        break;
    case "blog":
        include ("blog.php");
        break;
    case "contact-us":
        include ("contact.html");
        break;
}   


include ('includes/footer.php');
?>