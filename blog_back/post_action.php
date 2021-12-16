<?php
    
    include_once "login-class.php";
    include_once "config.php";
    $crud2 = new Dbcon();
    
    include "classPost.php";
    $post = new Post();

    
    $user = new Users();
    $uid = $_SESSION["uid"];

    if(isset($_POST["add"])){
        $title = $crud2->escape_string($_POST["title"]);
        $author = $crud2->escape_string($_POST["author"]);
        $category = $crud2->escape_string($_POST["category"]);
        $content = $crud2->escape_string($_POST["content"]);
        $name = $_FILES['file']['name'];

        $tmp_name = $_FILES['file']['tmp_name'];
        $post->addPost($name, $tmp_name, $title, $content, $category, $author);
    }

    if(isset($_GET["delete"])){
        $id = $_GET["delete"];
        $post->deletePost($id);
    }

    if(isset($_POST["editpost"])){
        $post_id = $crud2->escape_string($_POST["p_id"]);
        $title = $crud2->escape_string($_POST["title"]);
        $date = $crud2->escape_string($_POST["date"]);
        $author = $crud2->escape_string($_POST["author"]);
        $category = $crud2->escape_string($_POST["category"]);
        $content = $crud2->escape_string($_POST["content"]);
        $name = $_FILES['file']['name'];

        $tmp_name = $_FILES['file']['tmp_name'];
        //echo "editPost($name, $tmp_name, $title, $content, $date, $category, $author, $post_id)";
        $post->editPost($name, $tmp_name, $title, $content, $date, $category, $author, $post_id);
    }


    if(isset($_POST["addcat"])){
        $catname = $crud2->escape_string($_POST["name"]);
        $desc = $crud2->escape_string($_POST["desc"]);
        $post->addCat($catname, $desc);
    }


    if(isset($_POST["updatecat"])){
        $id = $crud2->escape_string($_POST["id"]);
        $catname = $crud2->escape_string($_POST["name"]);
        $desc = $crud2->escape_string($_POST["desc"]);
        $post->editCat($catname, $desc, $id);
    }

    if(isset($_GET["deletecat"])){
        $id = $_GET["deletecat"];
        $post->deleteCat($id);
    }

    if(isset($_POST["adduser"])){
        $fname = $crud2->escape_string($_POST["fname"]);
        $surname = $crud2->escape_string($_POST["surname"]);
        $email = $crud2->escape_string($_POST["email"]);
        $ulvl = $crud2->escape_string($_POST["ulvl"]);
        $uname = $crud2->escape_string($_POST["uname"]);
        $pword = $crud2->escape_string($_POST["pword"]);
        $post->addUser($fname, $surname, $email, $ulvl, $uname, $pword);
    }

    if(isset($_GET["deleteuser"])){
        $id = $_GET["deleteuser"];
        $post->deleteUser($id);
    }

    if(isset($_POST["updateuser"])){
        $id = $crud2->escape_string($_POST["id"]);
        $fname = $crud2->escape_string($_POST["fname"]);
        $surname = $crud2->escape_string($_POST["surname"]);
        $email = $crud2->escape_string($_POST["email"]);
        $ulvl = $crud2->escape_string($_POST["ulvl"]);
        $uname = $crud2->escape_string($_POST["uname"]);
        $post->updateUser($fname, $surname, $email, $ulvl, $uname, $id);
    }

    # For My Accounts Page 

    if(isset($_POST["editname"])){
        $fname = $crud2->escape_string($_POST["fname"]);
        $sname = $crud2->escape_string($_POST["sname"]);
        //echo $uid;
        $user->updateName($fname, $sname, $uid);
    }

    if(isset($_POST["editemail"])){
        $email = $crud2->escape_string($_POST["email"]);
        $user->updateEmail($email, $uid);
    }

    if(isset($_POST["edituser"])){
        $username = $crud2->escape_string($_POST["user"]);
        $user->updateUser($username,$uid);
    }

    if(isset($_POST["editpass"])){
        $newpass1 = $crud2->escape_string($_POST["newpass1"]);
        $newpass2 = $crud2->escape_string($_POST["newpass2"]);
        $id = $crud2->escape_string($_POST["id"]);

        $user->newPass($newpass1, $newpass2, $id);
    }

    # Forgot Password

    if(isset($_POST["forgot"])){
        $email = $crud2->escape_string($_POST["email"]);
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $crud2->numRows($sql);
        $data = $crud2->get($sql);
        if($result == 0){
            $_SESSION["response"]= "Email does not exist.";
            $_SESSION["res_type"]="danger";
            header("location:login.php");              
                
        }else{
            $id = $data["user_id"];
            header("location:newpass.php?id=$id");
        }
    }

?>