<?php
    session_start();
    $id = $_GET["id"];
    include "login-class.php";
    $user = new Users();
    $form = $_POST["form"];
?>
<html>
    <head>
        <title>New Pasword</title>
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
                <form action="post_action.php" method="post">
                    <input type="text" hidden name="id" value="<?php echo $id; ?>"/>
                    <div class="form-group">
                        <label for="newpass1">Enter your new password<span class="text-danger">*</span></label>
                        <input type="password" name="newpass1" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="newpass2">Re-enter the new password <span class="text-danger">*</span></label>
                        <input type="password" name="newpass2" class="form-control">
                    </div>
                    <span class="text-danger">* Required</span>
        
                    <div class="form-group">
                        <input type="submit" name="editpass" class="btn btn-primary float-right" value="Modify"/>
                    </div>
                </form>
                    
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </body>
</html>