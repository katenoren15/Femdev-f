<?php
    include ('header.php');
    include_once "../blog_back/config.php";
    $crud2 = new Dbcon();

    session_start();
    $topic_id = $_GET["id"];
    setcookie("topic_id", $topic_id);
    $query= "SELECT topics.topic_subject, topics.topic_content, topics.topic_by, topics.topic_image, topics.topic_date, topics.topic_id, users.first_name, users.surname, categories.cat_name FROM topics, users, categories WHERE topics.topic_id='$topic_id' and topics.topic_by = users.user_id";
    $ret = $crud2->get($query);
    $date = $ret["topic_date"];


    //$query2 = "SELECT * from posts, users WHERE post_topic = '$topic_id' and posts.post_by= users.user_id ORDER BY post_date";
    //$ret2 = $crud2->get($query2);


?>
<body>
<section class="xs-section-padding ">
    <div class="container-fluid">
                    <?php
                        //foreach($ret as $key => $row){
                    ?>
        <div class="col-md-12 text-center">
            <h1 class="text-body"><?= $ret["topic_subject"];?></h1><br>
            <h5>By <span class="text-danger"> <?php echo $ret["first_name"];?></span> on <?php echo date('F d, Y', strtotime($date));?></h5>
            <h5>Category: <?php echo $ret["cat_name"];?></h5>
            <br>

                <?php 
                    if ($ret["topic_image"] == NULL or !$ret["topic_image"]){
                ?>
                        <img src="../assets/images/noimage.png" class="" data-retina="" alt="" />

                <?php
                    } else{
                ?>
                        
                        <img src="../assets/images/<?php echo $ret["topic_image"];?>" class="" data-retina="" alt="" style="width:40%;height:40%;"/>
                <?php
                    }
                ?>
<br><br>
            <p class="" style="color:black;font-size:14pt;"><?php echo $ret["topic_content"]; ?></p>
        </div>
                        <?php //} ?>
       
    </div>
</section>


<?php
include ('../includes/footer.php');
?>