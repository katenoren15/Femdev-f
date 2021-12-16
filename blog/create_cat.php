<?php
   require_once('includes/dbconnect.php');
   $connection = db_connect(); 
   session_start();
   if($_SESSION["loggedin"]== false){
    echo " <br><div class='alert alert-warning' role='alert'>You must first <a href='index2.php?page=login'>login</a> before adding a category.</div>";
    }else{
        if(isset($_POST["cate"])){
        $catname=mysqli_real_escape_string($connection, $_POST["cat-name"]);
        $catdesc=mysqli_real_escape_string($connection, $_POST["cat-description"]);
        $query="INSERT INTO categories(cat_name, cat_description) VALUES ('$catname', '$catdesc')";
        $ret= mysqli_query($connection, $query);
        if($ret){
             echo "<div class='alert alert-success' role='alert'>New category added.</div>";
         }else{
            echo "<div class='alert alert-danger' role='alert'>Error" . mysqli_error($connection) ."</div>";
         }
    }
   
?>
<div class="container-fluid">
    <div class="row">
    <h1>Create a Category</h1>
    <br>
        <div class="col-sm-6">
            <form action=" " method="POST">
                <div class="form-group">
                    <label for="cat-name">Category Name:</label><br>
                    <input type="text" class="form-control"name="cat-name"/>
                </div>
                <div class="form-group">
                    <label for="cat-description">Category Description:</label><br>
                    <textarea class="form-control register"name="cat-description"></textarea><br>
                </div>
                <input type="submit" name="cate" class="btn btn-default" value="Add category"/>
            </form>
            <br>
        </div>
    </div>
</div>
        <?php } ?>