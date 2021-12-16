<?php
session_start();
include_once "header.php";
include_once "config.php";
$crud2 = new Dbcon();

// Set session
if(isset($_POST['records-limit'])){
    $_SESSION['records-limit'] = $_POST['records-limit'];
}

$limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 10;
$pge = (isset($_GET['pge']) && is_numeric($_GET['pge']) ) ? $_GET['pge'] : 1;
$paginationStart = ($pge - 1) * $limit;
$sql = "SELECT * FROM categories, topics, users WHERE categories.cat_id = topics.topic_cat AND topics.topic_by = users.user_id ORDER BY topic_date desc LIMIT $paginationStart, $limit";
$result = $crud2->read($sql);

// Prev + Next
$prev = $pge - 1;
$next = $pge + 1;

// Get total records
$sql2 = "SELECT COUNT(*) as total FROM topics ORDER BY topic_date desc";
$result2 = $crud2->get($sql2);
$allRecords = $result2["total"];

// Calculate total pages
$totalPages = ceil($allRecords / $limit);

$sql3 = "SELECT * FROM categories";
$result3 = $crud2->read($sql3);

$sql5 = "SELECT * FROM users";
$result5 = $crud2->read($sql5);

$sql4 = "SELECT COUNT(*) as posts FROM topics";
$result4 = $crud2->get($sql4); 
?>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-11 col-lg-9 col-md-8 ml-auto">
                <div class="jumbotron pt-4 pb-4 mt-3">
                    <h1>Posts</h1>
                    <nav class="navbar">
                    <button class="btn btn-primary mt-1 navbar-brand" data-toggle="modal" data-target="#addpost">&plus;&nbsp;Post</button>
                    <form class="form-inline">
                        <input class="form-control border-primary mr-sm-2" type="search" id="pinput" placeholder="Search" aria-label="Search">
                    </form>
                </nav>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-xl-11 col-lg-9 col-md-8 ml-auto">
                <?php if(isset($_SESSION["response"])){ ?>
                    <div class="alert text-center alert-<?= $_SESSION["res_type"]; ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b><?= $_SESSION["response"];?></b>
                    </div>
                <?php } unset($_SESSION["response"]); ?>
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-xl-11 col-lg-9 col-md-8 ml-auto">
                <h5><b>Number of Blog Posts: </b><?= $result4["posts"] ?></h5>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-xl-11 col-lg-9 col-md-8 ml-auto">
                <div class="table-responsive" id="result">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-dark">Date</th>
                                <th class="text-dark">Title</a></th>
                                <th class="text-dark">Author</th>
                                <th class="text-dark">Category</th>
                                <th class="text-dark">Content</th>
                                <th colspan="2" class="text-center text-dark">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="posTable">
                        <?php foreach($result as $key => $row){ ?>
                            <tr>
                                <td><?= $row["topic_date"];?></td>
                                <td><?= $row["topic_subject"];?></td>
                                <td><?= $row["first_name"];?></td>
                                <td><?= $row["cat_name"];?></td>
                                <td><?= $row["topic_content"];?></td>
                                
                                <td class="text-center">
                                    <a href="viewpost.php?id=<?= $row["topic_id"]; ?>" class="btn btn-warning">View</a>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary" href="edit.php?type=modifypost&post=<?php echo $row["topic_id"]; ?>">Edit</a></br>
                                    
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation example mt-5">
                <ul class="pagination justify-content-end">
                    <li class="page-item <?php if($pge <= 1){ echo 'disabled'; } ?>">
                        <a class="page-link"
                            href="<?php if($pge <= 1){ echo '#'; } else { echo "index.php?page=posts&pge=" . $prev; } ?>">Previous</a>
                    </li>

                    <?php for($i = 1; $i <= $totalPages; $i++ ): ?>
                    <li class="page-item <?php if($pge == $i) {echo 'active'; } ?>">
                        <a class="page-link" href="index.php?page=posts&pge=<?= $i; ?>"> <?= $i; ?> </a>
                    </li>
                    <?php endfor; ?>

                    <li class="page-item <?php if($page >= $totalPages) { echo 'disabled'; } ?>">
                        <a class="page-link"
                            href="<?php if($pge >= $totalPages){ echo '#'; } else {echo "index.php?page=posts&pge=". $next; } ?>">Next</a>
                    </li>
                </ul>
            </nav>
            </div>
        </div>

    </div>
</section>
<div class="modal fade" id="addpost">

    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Add a Post</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <span class="text-danger float-right">* Required</span>
                <form action="post_action.php" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="id" />
                    <div class="form-group mt-2">
                        <label for="title">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required/>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="author">Author<span class="text-danger">*</span></label>
                                <select name="author" class="form-control" required/>
                                    <?php 
                                        foreach ($result5 as $key => $row){
                                            echo "<option value='". $row["user_id"]. "'>" . $row["first_name"] . " " . $row["surname"] ."</option>";
                                        }
                                    ?>   
                                </select>
                        </div>
                        <div class="col">
                            <label for="category">Category <span class="text-danger">*</span></label>
                                <select name="category" class="form-control" required/>
                                    <?php 
                                        foreach ($result3 as $key => $row){
                                            echo "<option value='". $row["cat_id"]. "'>" . $row["cat_name"] . "</option>";
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
                        <textarea name="content" class="form-control" rows="50"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Cancel"/>
                    <input type="submit" name="add" class="btn btn-primary" value="Add"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editpost">

    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Edit Post</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="client_action.php" method="POST" id="live_form">
                    <input type="hidden" name="id" />
                    <div class="form-group mt-2">
                        <label for="title">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" required/>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="author">Author <span class="text-danger">*</span></label>
                                <input type="text" name="author" id="author" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="category">Category <span class="text-danger">*</span></label>
                                <input type="text" name="category" id="category" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control"/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" class="form-control" rows="50"></textarea>
                    </div>
                    <span class="text-danger">* Obligatoire</span>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Cancel"/>
                    <input type="submit" name="update" class="btn btn-primary" value="Modify"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#pinput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#posTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
    $(document).ready( function() {
        $('.editbtn').on('click', function () {

            $('#editpost').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#title').val(data[1]);
            $('#author').val(data[2]);
            $('#category').val(data[3]);
            $('#content').val(data[4]);

        });
    });
</script>