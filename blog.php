<?php
     include_once "blog_back/config.php";
     $crud2 = new Dbcon();
     session_start();
     $userid = $_SESSION["userid"];
     $t_id = $_COOKIE["topic_id"];

    // Set session
    if(isset($_POST['records-limit'])){
        $_SESSION['records-limit'] = $_POST['records-limit'];
    }

    $limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 5;
    $pge = (isset($_GET['pge']) && is_numeric($_GET['pge']) ) ? $_GET['pge'] : 1;
    $paginationStart = ($pge - 1) * $limit;
    $query= "SELECT topics.topic_subject, topics.topic_date, topics.topic_content, topics.topic_image, topics.topic_id, categories.cat_name FROM topics, categories WHERE topics.topic_cat= categories.cat_id ORDER BY topics.topic_date desc LIMIT $paginationStart, $limit";
    $ret = $crud2->read($query);
     
     if(!$ret){
        echo "<div class='alert alert-danger' role='alert'>Error" . mysqli_error($connection) ."</div>";
     }

     // Prev + Next
    $prev = $pge - 1;
    $next = $pge + 1;

    // Get total records
    $sql2 = "SELECT COUNT(*) as total FROM topics ORDER BY topic_date desc";
    $result2 = $crud2->get($sql2);
    $allRecords = $result2["total"];

    // Calculate total pages
    $totalPages = ceil($allRecords / $limit);
?>
<div id="preloader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
    <!-- #preloader -->

    <section class="xs-banner-inner-section about-window" style="background-image:url('assets/images/bg-4.jpg');">
        <div class="xs-black-over"></div>
        <div class="container">
            <div class="color-white xs-inner-banner-content capacity_building">
                <h1>Blog</h1>
                <p></p>
            </div>
            <div class="row">
            
            </div>
        </div>
    </section>
    <section class="xs-section-padding ">
        <div class="container">
            <div class="col-md-12">
            
                    <?php
                        foreach($ret as $key => $row){
                    ?>
                        <div class="jumbotron jumbotron-fluid p-4" style="border-radius:5px;">
                            <div class="container">     
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?php 
                                            if ($row["topic_image"] == NULL or !$row["topic_image"]){
                                        ?>
                                                <img src="assets/images/noimage.png" class="rounded img-thumbnail img-fluid float-left" data-retina="" alt="" />

                                        <?php
                                            } else{
                                        ?>
                                                
                                        <img src="assets/images/<?php echo $row["topic_image"];?>" class="rounded img-thumbnail img-fluid float-left" data-retina="" alt="" />
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="col-sm-8">
                                        <h1 style="color:#041D57;"><?php echo $row["topic_subject"]; ?></h1>
                                        <span style="font-size:11pt;"><?php echo date('F d, Y', strtotime($row["topic_date"]));?> &nbsp;&nbsp;|| &nbsp;&nbsp;</span> <span style="font-size:11pt;"> <u>Category:</u> <?php echo $row["cat_name"]; ?></span>
                                        <hr>
                                        <p><?php echo substr($row["topic_content"],0,100)."..." ; ?></p>
                                        <span class="float-right"><a class="btn btn-primary" href="blog/posts.php?id=<?php echo $row['topic_id']; ?>" class="btn btn-primary">
                                            Read More
                                        </a></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php } ?>
                <nav aria-label="Page navigation example mt-5">
                    <ul class="pagination pagination-lg justify-content-end">
                        <li class="page-item <?php if($pge <= 1){ echo 'disabled'; } ?>">
                            <a class="page-link"
                                href="<?php if($pge <= 1){ echo '#'; } else { echo "index.php?page=blog&pge=" . $prev; } ?>">Previous</a>
                        </li>

                        <?php for($i = 1; $i <= $totalPages; $i++ ): ?>
                        <li class="page-item <?php if($pge == $i) {echo 'active'; } ?>">
                            <a class="page-link" href="index.php?page=blog&pge=<?= $i; ?>"> <?= $i; ?> </a>
                        </li>
                        <?php endfor; ?>

                        <li class="page-item <?php if($page >= $totalPages) { echo 'disabled'; } ?>">
                            <a class="page-link"
                                href="<?php if($pge >= $totalPages){ echo '#'; } else {echo "index.php?page=blog&pge=". $next; } ?>">Next</a>
                        </li>
                    </ul>
                </nav>
                </div>
        </div>
    </section>
    <!--<section class="xs-section-padding ">
        <div class="container">
            <div class="col-md-12">
                    <?php
                       // foreach($ret as $key => $row){
                    ?>
                <div class="jumbotron jumbotron-fluid p-4" style="border-radius:5px;">
                    <div class="container">     
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="assets/images/<?php //echo $row["topic_image"];?>" class="rounded img-thumbnail float-left" data-retina="" alt="" />
                            </div>
                            <div class="col-sm-8">
                                <h1 style="color:#041D57;"><?php //echo $row["topic_subject"]; ?></h1>
                                <span style="font-size:13pt;"><u>Posted:</u> <?php //echo date('F d, Y', strtotime($row["topic_date"]));?> &nbsp;&nbsp;|| &nbsp;&nbsp;</span> <span style="font-size:13pt;"> <u>Category:</u> <?php echo $row["cat_name"]; ?></span>
                                <hr>
                                <p><?php //echo substr($row["topic_content"],0,100)."..." ; ?></p>
                                <span class="mx-auto d-block"><a class="btn btn-primary" href="blog/posts.php?id=<?php //echo $row['topic_id']; ?>" class="btn btn-primary">
                                    Read More
                                </a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php //} ?>

            </div>
        </div>
    </section> -->