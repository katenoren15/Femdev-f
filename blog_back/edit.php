<?php
session_start();
    include_once "header.php";
    include_once "config.php";
    $crud = new Dbcon();


    if($_GET["type"] == "modifypost"){
        $post_id = $_GET["post"];
        $sql = "SELECT * FROM categories, topics, users WHERE categories.cat_id = topics.topic_cat AND topics.topic_by = users.user_id AND topic_id='$post_id'";;
        $result = $crud->get($sql);
        $sql3 = "SELECT * FROM categories";
        $result3 = $crud->read($sql3);
        $sql4 = "SELECT * FROM users";
        $result4 = $crud->read($sql4);

?>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-3 mr-auto text-center">
            <a href="viewpost.php?id=<?php echo $post_id; ?>" class="btn btn-warning text-center mt-3"><i class="fas fa-arrow-alt-circle-left"></i><br></a>
            </div>
            <div class="col-md-7 ml-auto">
                <h4 class="text-center mt-3">Edit Post</h4>
                <form action="post_action.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="p_id" hidden value="<?php echo $result["topic_id"];?>"/>
                    <div class="form-group mt-2">
                        <label for="title">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" required value="<?php echo $result['topic_subject'];?>"/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="title">Date (YYYY-MM-DD HH:MM:SS)<span class="text-danger">*</span></label>
                            <input type="text" name="date" id="date" class="form-control" required value="<?php echo $result['topic_date'];?>"/>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="author">Author <span class="text-danger">*</span></label>
                            <select class="form-control" name="author" required>
                                <?php 
                                    foreach ($result4 as $key => $row){
                                        if ($row["user_id"] == $result["topic_by"]){
                                            echo "<option selected value='". $row["user_id"]. "'>" . $row["first_name"] ." ". $row["surname"] . "</option>";
                                        } else{
                                            echo "<option value='". $row["user_id"]. "'>" . $row["first_name"] ." ". $row["surname"] . "</option>";
                                        }
                                    }
                                ?>   
                            </select>
                        </div>
                        <div class="col">
                            <label for="category">Category <span class="text-danger">*</span></label>
                            <select class="form-control" name="category" required>
                                <?php 
                                    foreach ($result3 as $key => $row){
                                        if ($row["cat_id"] == $result["topic_cat"]){
                                            echo "<option selected='selected' value='". $row["cat_id"]. "'>" . $row["cat_name"] . "</option>";
                                        } else{
                                            echo "<option value='". $row["cat_id"]. "'>" . $row["cat_name"] . "</option>";
                                        }
                                    }
                                ?>   
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="file">Image</label>
                        <input type="file" name="file" id="file" class="form-control"/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" class="form-control" rows="10"><?php echo $result['topic_content'];?></textarea>
                    </div>
                
                    <span class="text-danger">* Required</span>
               
                <div class="form-group text-center">
                    <input type="reset" class="btn btn-danger" value="Cancel"/>
                    <input type="submit" name="editpost" class="btn btn-primary" value="Edit"/>
                </div>
                </form>
        </div>
            <div class="col-md-2 ml-auto"></div>
        </div>
    </div>
</section>

    <?php } 
     if($_GET["type"] == "modifyobs"){
        $prospect_id = $_GET["p"];
        $obs = $_GET["obs"];
        $sql = "SELECT * FROM customer_observation WHERE customer_id = '$prospect_id' AND obs_id = '$obs'";
        $result = $crud->get($sql);
    ?>
    <section>
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-3 mr-auto text-center">
                <a href="viewclient.php?id=<?php echo $prospect_id; ?>" class="btn btn-warning text-center mt-3"><i class="fas fa-arrow-alt-circle-left"></i><br></a>
                </div>
                <div class="col-md-7 mt-3 ml-auto">
                    <h4 class="text-center">Modifier l'observation</h4>
                    <form action="client_action.php" method="POST">
                        <input type="text" name="obsid" value="<?php echo $result['obs_id'];?>" hidden/>
                        <input type="text" name="pid" value="<?php echo $result['customer_id'];?>" hidden/>
                        <div class="form-group">
                            <label for="date_obs">Date d'Observation<span class="text-danger">*</span></label>
                            <input type="text" name="date_obs" id="date_obs" class="form-control datepicker" value="<?php echo $result['date_observation'];?>" required/>
                        </div>
                        <div class="form-group">
                            <label for="observation">Observations<span class="text-danger">*</span></label>
                            <textarea type="text" name="observation" id="observation" class="form-control" required><?php echo $result['observation'];?></textarea>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <input type="reset" class="btn btn-danger" value="Annuler"/>
                                <input type="submit" name="edito" class="btn btn-primary" value="Modifier"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 ml-auto"></div>
            </div>
        </div>
    </section>

    <?php }
    
    if($_GET["type"] == "modifyachat"){ 
        $client_id = $_GET["client"];
        $achat = $_GET["achat"];
        $sql = "SELECT * FROM client_account WHERE customer_id = $client_id AND transaction_id = '$achat'";
        $result = $crud->get($sql);
        ?>
        <section>
            <div class="container-fluid">
                <div class="row mt-5">
                <div class="col-md-3 mr-auto text-center">
                    <a href="viewclient.php?id=<?php echo $client_id; ?>" class="btn btn-warning text-center mt-3"><i class="fas fa-arrow-alt-circle-left"></i><br></a>
                </div>
                <div class="col-md-7 mt-4 ml-auto">
                    <h4 class="text-center">Modifier un achat</h4>
                    <form action="client_action.php" method="POST">
                    <input type="text" name="cid" id="cid" value="<?= $client_id;?>" hidden/>
                    <div class="form-row">
                        <div class="col">
                            <label for="num_trans">N&deg; Transaction </label>
                            <input type="text" name="num_trans" class="form-control" value="<?php echo $result["transaction_id"];?>" readonly/>
                        </div>
                        <div class="col">
                            <label for="date_trans">Date de Transaction<span class="text-danger">*</span></label>
                            <input type="text" name="date_trans" class="form-control datepicker" value="<?php echo $result["transaction_date"];?>" required/>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                            <label for="desc">Description</label>
                            <textarea name="desc" class="form-control"><?php echo $result["trans_desc"];?></textarea>
                        </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="total">Total<span class="text-danger">*</span></label>
                            <input type="text" name="total" class="form-control" value="<?php echo $result["total"];?>" required/>
                        </div>
                        <div class="col">
                            <label for="paye">Montant Pay&eacute;<span class="text-danger">*</span></label>
                            <input type="text" name="paye" class="form-control" value="<?php echo $result["amount_paid"];?>" required/>
                        </div>
                    </div>
                    <span class="text-danger">* Obligatoire</span>
                    <div class="form-group text-center">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="editachat" class="btn btn-primary" value="Modifier"/>
                </div>
                </div>
                <div class="col-md-2"></div>
                
    </div>
            </div>
        </section>

    <?php } ?>

    <script>
    $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
        firstDay: 1,
        dayNamesMin: [ "Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat" ],
        monthNames: ['January','February','March','April','May','June',
            'July','August','September','October','November','December'],
    });
</script>