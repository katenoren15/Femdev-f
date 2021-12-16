<?php
     require_once ('includes/dbconnect.php');
     $connection = db_connect();
     session_start();
     $userid = $_SESSION["userid"];
     $t_id = $_COOKIE["topic_id"];
     $query= "SELECT topics.topic_subject, topics.topic_date, topics.topic_id, categories.cat_name FROM topics, categories WHERE topics.topic_cat= categories.cat_id";
     $ret = mysqli_query($connection, $query);
     if(!$ret){
        echo "<div class='alert alert-danger' role='alert'>Error" . mysqli_error($connection) ."</div>";
     }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <br>
        <div class="container text-center">
            <div class="jumbotron">
                <h1>Welcome to Pastime Forum</h1>      
                <p>Sample text. Sample text. Sample text. Sample text. Sample text. Sample text. Sample text. Sample text. Sample text. 
                Sample text. Sample text. Sample text.</p>
            </div>
        </div>  
        <br>
        <div >
            <table class="table-responsive table table-bordered" border="1">
                <tr>
                    <th>Topics</a></th>
                    <th>Category</th>
                    <th>Date and Time</th>
                </tr>
                <?php
                while($row = mysqli_fetch_array($ret)){
                ?>
                <tr>
                    <td><a href="forum/topics.php?id=<?php echo $row['topic_id']; ?>"><?php echo $row["topic_subject"]; ?></a></td>
                    <td> <?php echo $row["cat_name"]; ?> </td>
                    <td> <?php echo $row["topic_date"];?> </td>
                </tr>
                <?php } ?>
                <tr>
                    <td align="right" colspan="3"><a href="index1.php?page=create-topic">Create a Topic</a></td>
                </tr>
             </table>

        </div>
        </div>
    </div>
</div>
