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
$sql = "SELECT * FROM categories LIMIT $paginationStart, $limit";
$result = $crud2->read($sql);

// Prev + Next
$prev = $pge - 1;
$next = $pge + 1;

// Get total records
$sql2 = "SELECT COUNT(*) as total FROM categories";
$result2 = $crud2->get($sql2);
$allRecords = $result2["total"];

// Calculate total pages
$totalPages = ceil($allRecords / $limit);

$sql3 = "SELECT * FROM categories";
$result3 = $crud2->read($sql3);

$sql5 = "SELECT * FROM users";
$result5 = $crud2->read($sql5);

$sql4 = "SELECT COUNT(*) as categories FROM categories";
$result4 = $crud2->get($sql4); 
?>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-11 col-lg-9 col-md-8 ml-auto">
                <div class="jumbotron pt-4 pb-4 mt-3">
                    <h1>Categories</h1>
                    <nav class="navbar">
                    <button class="btn btn-primary mt-1 navbar-brand" data-toggle="modal" data-target="#addpost">&plus;&nbsp;Category</button>
                    <form class="form-inline">
                        <input class="form-control border-primary mr-sm-2" type="search" id="cinput" placeholder="Search" aria-label="Search">
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
                <h5><b>Number of Categories: </b><?= $result4["categories"] ?></h5>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-xl-11 col-lg-9 col-md-8 ml-auto">
                <div class="table-responsive" id="result">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-dark">Category ID</th>
                                <th class="text-dark">Name</a></th>
                                <th class="text-dark">Description</th>
                                <th colspan="2" class="text-center text-dark">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="caTable">
                        <?php foreach($result as $key => $row){ ?>
                            <tr>
                                <td><?= $row["cat_id"];?></td>
                                <td><?= $row["cat_name"];?></td>
                                <td><?= $row["cat_description"];?></td>
            
                                <td class="text-center">
                                    <button class="btn btn-primary mt-1 editbtn" data-toggle="modal" data-target="#editcat">Modify</button>
                                </td>
                                <td class="text-center">
                                    <a href="post_action.php?deletecat=<?= $row["cat_id"]; ?>" class="btn btn-danger mt-1 justify-content-center" onclick="return confirm('Do you want to delete this category?');">Delete</a>
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
                            href="<?php if($pge <= 1){ echo '#'; } else { echo "index.php?page=categories&pge=" . $prev; } ?>">Previous</a>
                    </li>

                    <?php for($i = 1; $i <= $totalPages; $i++ ): ?>
                    <li class="page-item <?php if($pge == $i) {echo 'active'; } ?>">
                        <a class="page-link" href="index.php?page=categories&pge=<?= $i; ?>"> <?= $i; ?> </a>
                    </li>
                    <?php endfor; ?>

                    <li class="page-item <?php if($page >= $totalPages) { echo 'disabled'; } ?>">
                        <a class="page-link"
                            href="<?php if($pge >= $totalPages){ echo '#'; } else {echo "index.php?page=categories&pge=". $next; } ?>">Next</a>
                    </li>
                </ul>
            </nav>
            </div>
        </div>

    </div>
</section>
<div class="modal fade" id="addpost">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Add a Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <span class="text-danger float-right">* Required</span>
                <form action="post_action.php" method="POST">
                    <input type="hidden" name="id" />
                    <div class="form-group mt-2">
                        <label for="name">Name<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="desc">Description<span class="text-danger">*</span></label>
                        <textarea name="desc" class="form-control"></textarea/>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Cancel"/>
                    <input type="submit" name="addcat" class="btn btn-primary" value="Add"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editcat">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Edit Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="post_action.php" method="POST" id="live_form">
                    <input type="hidden" name="id" id="id" />
                    <div class="form-group mt-2">
                        <label for="name">Name<span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="desc">Description<span class="text-danger">*</span></label>
                        <textarea name="desc" id="desc" class="form-control"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Cancel"/>
                    <input type="submit" name="updatecat" class="btn btn-primary" value="Modify"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#cinput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#caTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
    $(document).ready( function() {
        $('.editbtn').on('click', function () {

            $('#editcat').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#id').val(data[0]);
            $('#name').val(data[1]);
            $('#desc').val(data[2]);

        });
    });
</script>