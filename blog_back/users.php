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
$sql = "SELECT * FROM users LIMIT $paginationStart, $limit";
$result = $crud2->read($sql);

// Prev + Next
$prev = $pge - 1;
$next = $pge + 1;

// Get total records
$sql2 = "SELECT COUNT(*) as total FROM users";
$result2 = $crud2->get($sql2);
$allRecords = $result2["total"];

// Calculate total pages
$totalPages = ceil($allRecords / $limit);

$sql3 = "SELECT * FROM users";
$result3 = $crud2->read($sql3);

$sql5 = "SELECT * FROM users";
$result5 = $crud2->read($sql5);

$sql4 = "SELECT COUNT(*) as users FROM users";
$result4 = $crud2->get($sql4); 
?>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-11 col-lg-9 col-md-8 ml-auto">
                <div class="jumbotron pt-4 pb-4 mt-3">
                    <h1>Users</h1>
                    <nav class="navbar">
                    <button class="btn btn-primary mt-1 navbar-brand" data-toggle="modal" data-target="#adduser">&plus;&nbsp;User</button>
                    <form class="form-inline">
                        <input class="form-control border-primary mr-sm-2" type="search" id="uinput" placeholder="Search" aria-label="Search">
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
                <h5><b>Number of Users: </b><?= $result4["users"] ?></h5>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-xl-11 col-lg-9 col-md-8 ml-auto">
                <div class="table-responsive" id="result">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-dark">User ID</th>
                                <th class="text-dark">First Name</a></th>
                                <th class="text-dark">Surname</th>
                                <th class="text-dark">Email</th>
                                <th class="text-dark">User Level</th>
                                <th class="text-dark">Username</th>
                                <th colspan="2" class="text-center text-dark">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTable">
                        <?php foreach($result as $key => $row){ ?>
                            <tr>
                                <td><?= $row["user_id"];?></td>
                                <td><?= $row["first_name"];?></td>
                                <td><?= $row["surname"];?></td>
                                <td><?= $row["email"];?></td>
                                <td><?= $row["user_level"];?></td>
                                <td><?= $row["username"];?></td>
            
                                <td class="text-center">
                                    <button class="btn btn-primary mt-1 editbtn" data-toggle="modal" data-target="#edituser">Modify</button>
                                </td>
                                <td class="text-center">
                                    <a href="post_action.php?deleteuser=<?= $row["user_id"]; ?>" class="btn btn-danger mt-1 justify-content-center" onclick="return confirm('Do you want to delete this user?');">Delete</a>
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
<div class="modal fade" id="adduser">

    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Add a User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="post_action.php" method="POST">
                    <input type="hidden" name="id" />
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="fname">First Name<span class="text-danger">*</span></label>
                            <input type="text" name="fname" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="surname">Surname<span class="text-danger">*</span></label>
                            <input type="text" name="surname" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="ulvl">User Level<span class="text-danger">*</span></label>
                            <select name="ulvl" class="form-control" required/>
                                <option name="ulvl">Admin</option>
                                <option name="ulvl">Writer</option>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="uname">Username<span class="text-danger">*</span></label>
                            <input type="text" name="uname" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="pword">Password<span class="text-danger">*</span></label>
                            <input type="password" name="pword" class="form-control" required/>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Cancel"/>
                    <input type="submit" name="adduser" class="btn btn-primary" value="Add"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edituser">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="post_action.php" method="POST" id="live_form">
                    <input type="hidden" name="id" id="id" />
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="fname">First Name<span class="text-danger">*</span></label>
                            <input type="text" name="fname" id="fname" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="surname">Surname<span class="text-danger">*</span></label>
                            <input type="text" name="surname" id="surname" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="ulvl">User Level<span class="text-danger">*</span></label>
                            <select name="ulvl" class="form-control" required/>
                                <option name="ulvl">Admin</option>
                                <option name="ulvl">Writer</option>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="uname">Username<span class="text-danger">*</span></label>
                            <input type="text" name="uname" id="uname" class="form-control" required/>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Cancel"/>
                    <input type="submit" name="updateuser" class="btn btn-primary" value="Modify"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#uinput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#userTable tr").filter(function() {
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
            $('#fname').val(data[1]);
            $('#surname').val(data[2]);
            $('#email').val(data[3]);
            $('#ulvl').val(data[4]);
            $('#uname').val(data[5]);

        });
    });
</script>