<?php
   require_once('includes/dbconnect.php');
   $connection = db_connect(); 
   session_start();
   $userid = $_SESSION["userid"];

    if($_SESSION["loggedin"]== false){
        echo "<br><div class='alert alert-warning' role='alert'>You must first <a href='./index2.php?page=login'>login</a> before adding a topic.</div>";
    }else{
        $query = "SELECT cat_id, cat_name, cat_description FROM categories";
        $ret = mysqli_query($connection, $query);
        if(!$ret){
            echo "<div class='alert alert-danger' role='alert'>Error while selecting categories from database.</div>";
        }
        if(isset($_POST["topic-subject"])){
            $topsub = mysqli_real_escape_string($connection, $_POST["topic-subject"]);
            $topcat = mysqli_real_escape_string($connection, $_POST["topic-category"]);
            $postmessage = mysqli_real_escape_string($connection, $_POST["post_content"]);
            $query="INSERT INTO topics (topic_subject, topic_content, topic_date, topic_cat, topic_by) VALUES ('$topsub', '$postmessage', NOW(), '$topcat', '$userid')";
            $ret= mysqli_query($connection, $query);
            if($ret){
                echo "<div class='alert alert-success' role='alert'>New topic added.</div>";
            }else{
               echo "<div class='alert alert-danger' role='alert'>Error" . mysqli_error($connection) ."</div>";
            }
        }
?>
<div class="container-fluid">
    <div class="row">
    <h1>Create a Topic</h1>
    <br>
        <div class="col-sm-6">
            <form action=" " method="POST">
                <div class="form-group">
                    <label for="topic-subject">Subject:</label><br>
                    <input type="text" class="form-control" name="topic-subject"/>
                </div>
                <div class="form-group">
                    <label for="topic-category">Category:</label><br>
                    <select name="topic-category" class="form-control" required="required">
                        <?php 
                            while($row = mysqli_fetch_array($ret)){
                                echo "<option value='" . $row["cat_id"] ."'>". $row["cat_name"]. "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="post_content">Message:</label><br>
                    <textarea class="form-control" name="post_content" required="required" placeholder="Write your post."></textarea><br>
                </div>
                <input type="submit" name="topic" class="btn btn-default" value="Add topic"/>
            </form>
            <br>
        </div>
    </div>
</div>
                <?php } ?>