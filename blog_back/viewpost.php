<?php
session_start();
    include_once "header.php";
    include_once "config.php";
    $crud = new Dbcon();

    $post_id = $_GET["id"];
    $sql = "SELECT * FROM categories, topics, users WHERE categories.cat_id = topics.topic_cat AND topics.topic_by = users.user_id AND topic_id='$post_id'";
    $result = $crud->get($sql);


?>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-11 ml-auto">
            <h2 class="text-center mt-2"><?php echo $result["nom"] . " " . $result["prenoms"] ?></h2> 
                <div class="jumbotron p-2 mt-3">
                <h1 class="text-center"><?php echo $result["topic_subject"];?></h1>
                    <div class="d-flex">
                    
                        <div class="p-2 flex-grow-1">
                            <table class="table table-sm">
                                <tr class="">
                                    <td class="font-weight-bold col-4"><p>Date/Time Created: </p></td><td class=""><?php echo $result["topic_date"];?></td>
                                </tr>
                                <tr class="">
                                    <td class="font-weight-bold col-4"><p>Category:</td><td class=""><?php echo $result["cat_name"];?></td>
                                </tr>
                                <tr class="">
                                    <td class="font-weight-bold col-4"><p>Author: </p></td><td class=""><?php echo $result["first_name"] . " " . $result["surname"];?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="p-2 flex-grow-1">
                            <div class="text-center">
                                <a class="btn btn-warning" href="edit.php?type=modifypost&post=<?php echo $post_id; ?>">Edit</a></br></br>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-xl-11 col-lg-11 col-md-11 ml-auto">
                <?php if(isset($_SESSION["response"])){ ?>
                    <div class="alert text-center alert-<?= $_SESSION["res_type"]; ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b><?= $_SESSION["response"];?></b>
                    </div>
                <?php } unset($_SESSION["response"]); ?>
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-xl-11 col-lg-11 col-md-11 ml-auto">
                <div class="d-flex flex-row ml-auto">
                    <div class="p-2 col-md-4">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-dark"><h2>Image</h2></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php 
                                    if($result["topic_image"]){

                                ?>
                                    <td class=""><img class="img-thumbnail" src="../assets/images/<?php echo $result["topic_image"];?>"></td>
                                       
                                <?php
                                    }else{
                                ?>
                                    <td class="">No image</td>

                                <?php
                                    }
                                ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-2 col-md-8">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-dark"><h2>Content</h2></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo substr($result["topic_content"], 0, 10);?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
                    <a href="post_action.php?delete=<?= $result["topic_id"]; ?>" class="btn btn-danger mt-5 justify-content-center" onclick="return confirm('Do you want to delete this post?');">Delete</a>
                </div>
            
        </div>
       
    </div>
</secion>