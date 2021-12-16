<?php
/* Development and Debugging 
error_reporting(E_ALL);
ini_set('display_errors', TRUE); */ 
@$page = $_GET["page"];
    switch(@$page){
        case "":
            $index = "";
            $posts = "";
            $categories = "";
            $users = "";
            break;
        case "posts":
            $index = "";
            $posts = "current";
            $categories = "";
            $users = "";
            break;
        case "categories":
            $index = "";
            $posts = "";
            $categories = "current";
            $users = "";
            break;
        case "users":
            $index = "";
            $posts = "";
            $categories = "";
            $users = "current";
            break;
    }
       
?>
<?php
include_once "login-class.php";
$user = new Users();
$uid = $_SESSION['uid'];
if (!$user->get_session()) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/all.css" >
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/jquery/jquery-ui.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/iconic-bootstrap.css">
    <script src="../assets/jquery/jquery-3.4.1.js"></script>
    <script src="../assets/jquery/jquery-ui.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <style>
        .sidebar {
    height: 100vh;
    width: 230px;
    background-color:#041d57;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    box-shadow: black;
}
    </style>
</head>
<body>
<!--side Nav-->
    <div class="row"> 
                
                <div class="col-xl-1 col-lg-3 col-md-4 sidebar fixed-top">
                    <ul class="navbar-nav flex-column mt-5">
                        <li class="nav-item mt-5">
                            <a href="index.php?page=posts" class="nav-link p-2 mb-4 text-white text-center sidebar-link <?php echo $posts; ?>"><i class="far fa-newspaper" style="font-size:35px;"></i><br>Posts</a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=categories" class="nav-link p-2 mb-4  text-white text-center sidebar-link <?php echo $categories; ?>"><i class="fas fa-layer-group" style="font-size:35px;"></i><br><span class="ml-n1">Categories<span></a>
                        </li>
                        <?php 
                        
                            if($_SESSION["level"] == "Admin"){

                         ?>
                        <li class="nav-item">
                            <a href="index.php?page=users" class="nav-link p-2 mb-4  text-white text-center sidebar-link <?php echo $users; ?>"><i class="fas fa-users" style="font-size:35px;"></i><br><span class="ml-n1">Users<span></a>
                        </li>
                     <?php } ?>
                    </ul>
                      
                </div>
                
                
    </div>
    <!--End of side nav-->
    <!--Top Nav-->
    <nav class="navbar navbar-expand-md navbar-light" >
        <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 ml-auto top-bar fixed-top top-nav" style="background-color:#626C84;min-height:20px;">
                        <div class="row align-item-center">
                            <div class="col-md-4">
                            <a href="index-client.php?page=tableau" class="navbar-brand text-white font-weight-bold py-3">Blog Management</a>
                            </div>
                            <div class="col-md-6">
                            
                            </div>
                            <div class="col-md-2">
                            <ul class="navbar navbar-nav justify-content-center">
                                <img src="../assets/icons/person-fill.svg" width="30" class="rounded-circle"> 
                                <li class="nav-item">
                                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">
                                        <?php $user->get_fullname($uid); ?>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="myaccount.php">My Account</a>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#sign-out">Logout</a>
                                    </div>
                                </li>
                            </ul> 
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </nav>
<!-- end of nav bar -->
<!--Signout Modal-->
<div class="modal fade" id="sign-out">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Logout</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Do you want to logout?
            </div>
            <div class="modal-footer">
                <a href="signout.php"><button type="button" class="btn btn-success">Logout</button></a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- End of SignOut modal -->
