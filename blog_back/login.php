<?php
    session_start();
    include "login-class.php";
    $user = new Users();
    $form = $_POST["form"];
?>
<html>
    <head>
        <title>Blog Login</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/jquery/jquery-ui.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/iconic-bootstrap.css">
    <script src="../assets/jquery/jquery-3.4.1.js"></script>
    <script src="../assets/jquery/jquery-ui.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
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
            <div class="row d-flex">
                <div class="col-md-4"></div> 
                <div class="col-md-4" id="box">
                    <?php
                        if(isset($_COOKIE["lock"])){
                            echo "<div class='alert alert-danger' role='alert'>Three failed attempts. Please wait 3 minutes.</div>";
                        }else {
                    ?>
                    <img src="../assets/images/FemDevlogo.png" class="mx-auto d-block center" id="logo"/>
                    <br>
                    
                    <?php
                        if($form == "Login") {
                            $login = $user->login($_POST["username"], $_POST["password"]);
                            if ($login){
                                header("location:index.php?page=posts");
                            }else{
                                $_SESSION["attempts"] += 1;
                                if($_SESSION["attempts"] >= 3){
                                    setcookie("lock",$_POST["username"],time() +180);
                                    $_SESSION["attempts"] = 0;
                                }
                                echo "<div class='alert alert-danger text-center' role='alert'>Nom d'utilisateur ou mot de passe incorrect.</div>.";
                            }
                        }}
                    ?>
                    <div class="row justify-content-center mt-2">
                        <div class="">
                            <?php if(isset($_SESSION["response"])){ ?>
                                <div class="alert text-center alert-<?= $_SESSION["res_type"]; ?> alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <b><?= $_SESSION["response"];?></b>
                                </div>
                            <?php } unset($_SESSION["response"]); ?>
                        </div>
                    </div>
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
                            <u><a data-toggle="modal" data-target="#editemail" class="mx-auto d-block">Forgot Password?</a></u>
                            <br>
                            <input type="submit" value="Login" class="btn btn-info"/>
                         
                        </div>
                    </form>
                    
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </body>

<div class="modal fade" id="editemail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Forgot Password?</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="post_action.php" method="post">
                    <div class="form-group">
                        <label for="email">Enter your email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <span class="text-danger">* Required</span>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="submit" name="forgot" class="btn btn-primary" value="Continue"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</html>