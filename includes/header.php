<?php

@$page = $_GET["page"];
    switch(@$page){
        case "":
            $index = "active";
            $aboutus = "";
            $capacityBuilding = "";
            $projectandneeds = "";
            $successStories = "";
            $gallery = "";
            $blog = "";
            $contactUs = "";
            break;
        case "home":
            $index = "active";
            $aboutus = "";
            $capacityBuilding = "";
            $projectandneeds = "";
            $successStories = "";
            $gallery = "";
            $blog = "";
            $contactUs = "";
            break;
        case "about-us":
            $index = "";
            $aboutus = "active";
            $capacityBuilding = "";
            $projectandneeds = "";
            $successStories = "";
            $gallery = "";
            $blog = "";
            $contactUs = "";
            break;
        case "capacity-building":
            $index = "";
            $aboutus = "";
            $capacityBuilding = "active";
            $projectandneeds = "";
            $successStories = "";
            $gallery = "";
            $blog = "";
            $contactUs = "";
            break;
        case "projects-and-needs":
            $index = "";
            $aboutus = "";
            $capacityBuilding = "";
            $projectandneeds = "active";
            $successStories = "";
            $gallery = "";
            $blog = "";
            $contactUs = "";
            break;
        case "success-stories":
            $index = "";
            $aboutus = "";
            $capacityBuilding = "";
            $projectandneeds = "";
            $successStories = "active";
            $gallery = "";
            $blog = "";
            $contactUs = "";
            break;
        case "gallery":
            $index = "";
            $aboutus = "";
            $capacityBuilding = "";
            $projectandneeds = "";
            $successStories = "";
            $gallery = "active";
            $blog = "";
            $contactUs = "";
            break;
        case "blog":
            $index = "";
            $aboutus = "";
            $capacityBuilding = "";
            $projectandneeds = "";
            $successStories = "";
            $gallery = "";
            $blog = "active";
            $contactUs = "";
            break;
        case "contact-us":
            $index = "";
            $aboutus = "";
            $capacityBuilding = "";
            $projectandneeds = "";
            $successStories = "";
            $gallery = "";
            $blog = "";
            $contactUs = "active";
    }
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>FEMDEV</title>
    <meta name="description" content="FEMDEV exists to strengthen the economic 
		and social capacities of women and girls to transform them into drivers of sustainable development">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="favicon.html">
    <link rel="stylesheet" href="aos-master/dist/aos.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/xsIcon.css">
    <link rel="stylesheet" href="assets/css/isotope.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <!--For Plugins external css-->
    <link rel="stylesheet" href="assets/css/plugins.css" />
    <link rel="icon" type="image/x-icon" href="assets/images/FemDevlogo.png"/>

    <!--Theme custom css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!--Theme Responsive css-->
    <link rel="stylesheet" href="assets/css/responsive.css" />


</head>

<body>

<nav class="navbar navbar-expand-md bg-light navbar-light">
    <div class="container-fluid">
        <a class="nav-brand" href="index.php?page=home">
            <img src="assets/images/FemDevlogo-trans.png" alt="" height="150" width="150">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse collapsibleNavbar">
            <ul class="nav float-right">
                <li class="nav-item col-md-10">
                    <script async src="https://cse.google.com/cse.js?cx=006140751344758873809:zcuhzrhquza"></script>
                    <div class="gcse-searchbox-only"></div>
                </li>
                <li class="nav-item col-md-2">
                    <a class="btn btn-primary" href="https://co.clickandpledge.com/sp/d1/default.aspx?wid=75848" class="btn btn-primary">
                        Donate Now
                    </a>
                </li>  
            </ul>
            
    </div>
</div>
</nav>
<nav class="navbar xs-header xs-fullWidth navbar-expand-md" style="background-color: #011b58;">
    <div class="collapse navbar-collapse collapsibleNavbar">
        <ul class="nav-menu navbar-nav display-block mx-auto">
            <li>
                <a href="index.php?page=home" class="<?php echo $index ?>">Home</a>
            </li>
            <li>
                <a href="index.php?page=about-us" class="<?php echo $aboutus ?>">About Us</a>
            </li>
            <li>
                <a href="index.php?page=capacity-building" class="<?php echo $capacityBuilding ?>">Capacity Building</a>
            </li>
            <li>
                <a href="index.php?page=projects-and-needs" class="<?php echo $projectandneeds ?>">Projects and Needs</a>
            </li>
            <li>
                <a href="index.php?page=success-stories" class="<?php echo $successStories ?>">Success Stories</a>
            </li>
            <li>
                <a href="index.php?page=gallery" class="<?php echo $gallery ?>">Gallery</a>
            </li>
            <li>
                <a href="index.php?page=blog" class="<?php echo $blog ?>">Blog</a>
            </li>
            <li>
                <a href="index.php?page=contact-us" class="<?php echo $contactUs ?>">Contact Us </a>
            </li>

        </ul>
    </div>  
</nav>

