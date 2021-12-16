<?php
    session_start();
    include "login-class.php";
    $user = new Users();
    $form = $_POST["form"];
?>
<html>
    <head>
        <title>Blog Login</title>
        <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/jquery/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/iconic-bootstrap.css">
    <script src="assets/jquery/jquery-3.4.1.js"></script>
    <script src="assets/jquery/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
        <style>
            body {
                background-image: linear-gradient(to right bottom, #041d57, #001f6b, #00207e, #002092, #0a1ea5);
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            #box{
                background-color: white;
                box-shadow: 1px 2px 5px black;
                transition: all .4s;
                border-radius: 10px;
                padding:20px;
                margin-top:100px;
            }

        </style>
    </head>


    <body>
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-3"></div>
               
                <div class="col-md-6" id="box">
                <?php
                if(isset($_COOKIE["lock"])){
                    echo "<div class='alert alert-danger' role='alert'>3 mauvaises tentatives. Veuillez patienter 3 minutes.</div>";
                }else {
                    ?>
                    <img src="assets/images/FemDevlogo.png" class="mx-auto d-block center" id="logo"/>
                    <br>
               
                     <?php
                        if($form == "Login") {
                            $login = $user->login($_POST["username"], $_POST["password"]);
                            if ($login){
                                header("location:home.php");
                            }else{
                                $_SESSION["attempts"] += 1;
                                if($_SESSION["attempts"] >= 3){
                                    setcookie("lock",$_POST["username"],time() +180);
                                    $_SESSION["attempts"] = 0;
                                }
                                echo "<div class='alert alert-danger text-center' role='alert'>Nom d'utilisateur ou mot de passe incorrect.</div>.";
                            }
                        }}?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <input type="hidden" name="form" value="Login"/>
                       <br>
                        <div class="text-center">
                            <input type="submit" value="Login" class="btn btn-info"/>
                            <br><br>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </body>
</html>