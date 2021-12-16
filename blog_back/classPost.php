<?php

    class Post {

        private $conn;

        function __construct(){
            include_once "config.php";

            $crud = new Dbcon();

            $this->conn = $crud->connect();
        }

        function addPost($name, $tmp_name, $title, $content, $category, $author){
            $crud = new Dbcon();

            $position= strpos($name, "."); 

            $fileextension= substr($name, $position + 1);

            $fileextension= strtolower($fileextension);

            $name1= strtolower($name);

            $final_file=str_replace(' ','-',$name1);


            if ($final_file){
                
                $path = '../assets/images/';
    
                if (!empty($final_file)){
                    if (move_uploaded_file($tmp_name, $path.$final_file)) {
                        $sql = "INSERT INTO `topics` (`topic_subject`, `topic_content`, `topic_image`, `topic_date`, `topic_cat`, `topic_by`) VALUES ('$title', '$content', '$final_file', CURRENT_TIMESTAMP(), '$category', '$author')";
                        //echo $sql;
                        if($crud->run_query($sql)){
                            header("location:main.php");
                            $_SESSION["response"] = "Blog post successfully added";
                            $_SESSION["res_type"] = "success";
                        } else {
                            $err = $crud->error($sql);
                            header("location:main.php");
                            $_SESSION["response"] = "Failed to add blog post  " . $err;
                            $_SESSION["res_type"] = "danger";
                        }    
                    }
                }
            } else{
                $sql = "INSERT INTO `topics` (`topic_subject`, `topic_content`, `topic_image`, `topic_date`, `topic_cat`, `topic_by`) VALUES ('$title', '$content', NULL, CURRENT_TIMESTAMP(), '$category', '$author')";
                        //echo $sql;
                        if($crud->run_query($sql)){
                            header("location:index.php?page=posts");
                            $_SESSION["response"] = "Blog post successfully added";
                            $_SESSION["res_type"] = "success";
                        } else {
                            $err = $crud->error($sql);
                            header("location:index.php?page=posts");
                            $_SESSION["response"] = "Failed to add blog post  " . $err;
                            $_SESSION["res_type"] = "danger";
                        }    
            }
        }


        function deletePost($id){
            $crud = new Dbcon();
            $sql = "DELETE FROM topics WHERE topic_id = '$id'";
            if($crud->run_query($sql)){
                header("location:index.php?page=posts");
                $_SESSION["response"] = "Post successfully deleted";
                $_SESSION["res_type"] = "success";
            } else {
                header("location:index.php?page=posts");
                $_SESSION["response"] = "Deletion failed!";
                $_SESSION["res_type"] = "danger";
            }
        }

        function editPost($name, $tmp_name, $title, $content, $date, $category, $author, $post_id){
            $crud = new Dbcon();

            if($name){
                $position= strpos($name, "."); 

                $fileextension= substr($name, $position + 1);

                $fileextension= strtolower($fileextension);

                $name1= strtolower($name);

                $final_file=str_replace(' ','-',$name1);
            
                $path = '../assets/images/';
    
                if (!empty($final_file)){
                    if (move_uploaded_file($tmp_name, $path.$final_file)) {
                        $sql = "UPDATE topics SET topic_subject = '$title', topic_content = '$content', topic_image = '$final_file', topic_date = '$date', topic_cat = '$category', topic_by = '$author' WHERE topic_id='$post_id'";
                        echo $sql;

                        if($crud->run_query($sql)){
                            header("location:viewpost.php?id=$post_id");
                            $_SESSION["response"] = "Blog post successfully modified";
                            $_SESSION["res_type"] = "success";
                        } else {
                            $err = $crud->error($sql);
                            header("location:viewpost.php?id=$post_id");
                            $_SESSION["response"] = "Modification failed " . $err;
                            $_SESSION["res_type"] = "danger";
                        } 
                    }
                }
            
            }else{
                $sql = "UPDATE topics SET topic_subject = '$title', topic_content = '$content', topic_date = '$date', topic_cat = '$category', topic_by = '$author' WHERE topic_id='$post_id'";
                        //echo $sql;
                        if($crud->run_query($sql)){
                            header("location:viewpost.php?id=$post_id");
                            $_SESSION["response"] = "Blog post successfully modified";
                            $_SESSION["res_type"] = "success";
                        } else {
                            $err = $crud->error($sql);
                            header("location:viewpost.php?id=$post_id");
                            $_SESSION["response"] = "Modification failed " . $err;
                            $_SESSION["res_type"] = "danger";
                        }   
            }
        }

        function addCat($catname, $desc){
            $crud = new Dbcon();
            $sql = "INSERT INTO `categories` (cat_name, cat_description) VALUES ('$catname', '$desc')";
            //echo $sql;
            if($crud->run_query($sql)){
                header("location:index.php?page=categories");
                $_SESSION["response"] = "Category successfully added";
                $_SESSION["res_type"] = "success";
            } else {
                $err = $crud->error($sql);
                header("location:index.php?page=categories");
                $_SESSION["response"] = "Failed to add category " . $err;
                $_SESSION["res_type"] = "danger";
            }
        }

        function editCat($catname, $desc, $id){
            $crud = new Dbcon();
            $sql = "UPDATE categories SET cat_name = '$catname', cat_description = '$desc' WHERE cat_id = '$id'";
            if($crud->run_query($sql)){
               $_SESSION["response"]= "Category successfully modified!";
               $_SESSION["res_type"]="success";
               header("location:index.php?page=categories");
            }else{
                $_SESSION["response"]= "Modification failed";
                $_SESSION["res_type"]="danger";
                header("location:index.php?page=categories");
            }
        }

        function deleteCat($id){
            $crud = new Dbcon();
            $sql = "DELETE FROM categories WHERE cat_id = '$id'";
            if($crud->run_query($sql)){
                header("location:index.php?page=categories");
                $_SESSION["response"] = "Category successfully deleted!";
                $_SESSION["res_type"] = "success";
            } else {
                header("location:index.php?page=categories");
                $_SESSION["response"] = "Failed to delete category!";
                $_SESSION["res_type"] = "danger";
            }
        }

        function addUser($fname, $surname, $email, $ulvl, $uname, $pword){
            $crud = new Dbcon();
            $sql9 = "SELECT * FROM users WHERE username = '$uname' AND email = '$email'";
            $result9 = $crud->numRows($sql9);
            if ($result9 == 0){
                $sql = "INSERT INTO users (`first_name`, `surname`, `email`, `user_level`, `username`, `passw`) VALUES ('$fname', '$surname', '$email', '$ulvl', '$uname', '$pword')";
                if($crud->run_query($sql)){
                    header("location:index.php?page=users");
                    $_SESSION["response"] = "User successfully added!";
                    $_SESSION["res_type"] = "success";
                } else {
                    header("location:index.php?page=users");
                    $_SESSION["response"] = "Failed to add user!";
                    $_SESSION["res_type"] = "danger";
                }
            }else{
                $_SESSION["response"]= "Username or email already taken.";
                $_SESSION["res_type"]="danger";
                header("location:index.php?page=users");
            }
        }

        function deleteUser($id){
            $crud = new Dbcon();
            $sql = "DELETE FROM users WHERE user_id = '$id'";
            if($crud->run_query($sql)){
                header("location:index.php?page=users");  
                $_SESSION["response"] = "User successfully deleted!";
                $_SESSION["res_type"] = "success";
            } else {
                header("location:index.php?page=users");
                $_SESSION["response"] = "Failed to delete user!";
                $_SESSION["res_type"] = "danger";
            }
        }

        function updateUser($fname, $surname, $email, $ulvl, $uname, $id){
            $crud = new Dbcon();
            $sql = "UPDATE users SET first_name = '$fname', surname='$surname', email = '$email', user_level = '$ulvl', username = '$uname' WHERE user_id = '$id'";
            if($crud->run_query($sql)){
               $_SESSION["response"]= "User successfully modified!";
               $_SESSION["res_type"]="success";
               header("location:index.php?page=users");
            }else{
                $_SESSION["response"]= "Modification failed";
                $_SESSION["res_type"]="danger";
                header("location:index.php?page=users");
            }
        }
        
    }

?>