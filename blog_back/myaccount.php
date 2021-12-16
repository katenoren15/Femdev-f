<?php
/* Development and Debugging
error_reporting(E_ALL);
ini_set('display_errors', TRUE); */

include_once "login-class.php";
$user = new Users();
$uid = $_SESSION['uid'];
if (!$user->get_session()) {
    header('location:login.php');
}
?>
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
        #settings{
            font-size: 14pt;
        }
        body{
            background:url("../assets/images/17580.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>


    <section>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-md-12 ml-auto">
                    <a href="index.php?page=posts" class="btn btn-danger"><img src="../assets/icons/box-arrow-left.svg" width="30" class="text-white mr-3" class="text-danger"/>Posts</a>
                    <h1 class="text-dark text-center">My Account</h1>
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-md-12 ml-auto">
                    <?php if(isset($_SESSION["response"])){ ?>
                        <div class="alert text-center alert-<?= $_SESSION["res_type"]; ?> alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <b><?= $_SESSION["response"];?></b>
                        </div>
                    <?php } unset($_SESSION["response"]); ?>
                </div>
            </div>
            <br><br>
            <div class="row mb-5">
                <div class="col-md-2 ml-auto"></div>
                <div class="col-md-8 ml-auto">
                    <div class="border rounded shadow-lg p-4 mb-4 bg-white">
                        <h4>Profile</h4><br>
                        <table class="table border-bottom">
                            <tr>
                                <td class="text-muted">Full Name</td><td id="settings"><?php $user->get_fullname($uid); ?></td> <td><button class="btn btn-warning" data-toggle="modal" data-target="#editname">Modify</button></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Email</td><td id="settings"><?php $user->get_email($uid); ?></td> <td><button class="btn btn-warning" data-toggle="modal" data-target="#editemail">Modify</button></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Username</td><td id="settings"><?php $user->get_username($uid); ?></td> <td><button class="btn btn-warning" data-toggle="modal" data-target="#edituser">Modify</button></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Password</td><td id="settings"><?php $user->get_password($uid); ?></td> <td><button class="btn btn-warning" data-toggle="modal" data-target="#editpass">Modify</button></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Access Level</td><td id="settings"><?php $user->get_access_level($uid); ?></td> <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-2 ml-auto"></div>
            </div>
        </div>
    </section>
<div class="modal fade" id="editname">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modify your Name</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="post_action.php" method="POST">
                    <div class="form-group">
                        <label for="fname">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="fname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sname">Surname <span class="text-danger">*</span></label>
                        <input type="text" name="sname" class="form-control">
                    </div>
                    <span class="text-danger">* Required</span>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Cancel"/>
                    <input type="submit" name="editname" class="btn btn-primary" value="Modify"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editemail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modify Email</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="post_action.php" method="post">
                    <div class="form-group">
                        <label for="email">Enter your new email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <span class="text-danger">* Required</span>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Cancel"/>
                    <input type="submit" name="editemail" class="btn btn-primary" value="Modify"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edituser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modify Username</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="post_action.php" method="post">
                    <div class="form-group">
                        <label for="user">Enter your new username <span class="text-danger">*</span></label>
                        <input type="text" name="user" class="form-control">
                    </div>
                    <span class="text-danger">* Required</span>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Cancel"/>
                    <input type="submit" name="edituser" class="btn btn-primary" value="Modify"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editpass">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modify Password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="post_action.php" method="post">
                    <div class="form-group">
                        <label for="newpass1">Enter your new password<span class="text-danger">*</span></label>
                        <input type="password" name="newpass1" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="newpass2">Re-enter the new password <span class="text-danger">*</span></label>
                        <input type="password" name="newpass2" class="form-control">
                    </div>
                    <span class="text-danger">* Required</span>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Cancel"/>
                    <input type="submit" name="editpass" class="btn btn-primary" value="Modify"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?php
    include("includes/footer.php");
?>

