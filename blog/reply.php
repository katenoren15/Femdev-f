<?php
    require_once('../includes/dbconnect.php');
    $connection = db_connect2(); 
    session_start();
    $userid = $_SESSION["userid"];
    $t_id = $_COOKIE["topic_id"];
    if($_SESSION["loggedin"]== false){
        echo "<div class='alert alert-warning' role='alert'>You must first <a href='../index2.php?page=login'>login</a> before adding a category.</div>";
    }else{
        if(isset($_POST["reply"])){
            $reply = mysqli_real_escape_string($connection, $_POST["reply"]);
            $query="INSERT INTO posts (post_content, post_date, post_topic, post_by) VALUES ('$reply', NOW(), '$t_id', '$userid')";
            $ret= mysqli_query($connection, $query);
            if($ret){
                echo "<div class='alert alert-success' role='alert'>New post added.</div>";
            }else{
               echo "<div class='alert alert-danger' role='alert'>Error" . mysqli_error($connection) ."</div>";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery-3.3.1.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/style.css"/> 
        <title>Reply</title>
    </head>
    <body>
        <ul id="navlist">
            <li class="home"><a href="index1.php?page=home"></a></li>
            <li class="prev"><a href="topics.php?id= <?php echo $t_id ?>"></a></li>
        </ul>
    </body>
 
</html>