<?php
    include "config.php";

    class Users extends Dbcon {

        public function login($username, $password){
            $user = $this->connect()->real_escape_string($username);
            $pass = $this->connect()->real_escape_string($password);
            $sql2 = "SELECT * FROM users WHERE username ='$user' and passw='$pass'";
            $result = mysqli_query($this->connect(), $sql2);
            $user_data = mysqli_fetch_array($result);
            $count_row = $result->num_rows;

            if($count_row == 1){
                $_SESSION["login"] = true;
                $_SESSION["uid"] = $user_data["user_id"];
                $_SESSION["level"] = $user_data["user_level"];
                return true;
            }else{
                return false;
            }
        }

        public function get_session() {
            return $_SESSION["login"];
        }

        public function get_fullname($uid) {
            $sql3 = "SELECT first_name, surname FROM users WHERE user_id = '$uid'";
            $result = mysqli_query($this->connect(), $sql3);
            $user_data = mysqli_fetch_array($result);
            echo $user_data["first_name"] . " " . $user_data["surname"];
        }

        public function get_username($uid) {
            $sql3 = "SELECT username FROM users WHERE user_id = '$uid'";
            $result = mysqli_query($this->connect(), $sql3);
            $user_data = mysqli_fetch_array($result);
            echo $user_data["username"];
        }

        public function get_access_level($uid) {
            $sql3 = "SELECT user_level FROM users WHERE user_id = '$uid'";
            $result = mysqli_query($this->connect(), $sql3);
            $user_data = mysqli_fetch_array($result);
            echo $user_data["user_level"];
        }
        public function get_email($uid) {
            $sql3 = "SELECT email FROM users WHERE user_id = '$uid'";
            $result = mysqli_query($this->connect(), $sql3);
            $user_data = mysqli_fetch_array($result);
            echo $user_data["email"];
        }

        public function get_password($uid) {
            $sql3 = "SELECT passw FROM users WHERE user_id = '$uid'";
            $result = mysqli_query($this->connect(), $sql3);
            $user_data = mysqli_fetch_array($result);
            $hidden_password = str_repeat("**", strlen($user_data["passw"]));
            echo $hidden_password;
            //echo $user_data["passw"];
        }

        public function updateName($fname, $sname, $uid){
            $sql4 = "UPDATE users SET first_name= '$fname', surname = '$sname' WHERE user_id = '$uid'";

            $result = mysqli_query($this->connect(), $sql4);

            if($result){
                $_SESSION["response"]= "Modified successfully!";
                $_SESSION["res_type"]="success";
                header("location:myaccount.php");
            }else{
                $_SESSION["response"]= "Modification failed.";
                $_SESSION["res_type"]="danger";
                header("location:myaccount.php");
            }
        }

        public function updateEmail($email, $uid){
            $sql4 = "UPDATE users SET email = '$email' WHERE user_id = '$uid'";

            $result = mysqli_query($this->connect(), $sql4);

            if($result){
                $_SESSION["response"]= "Modified successfully!";
                $_SESSION["res_type"]="success";
                header("location:myaccount.php");
            }else{
                $_SESSION["response"]= "Modification failed.";
                $_SESSION["res_type"]="danger";
                header("location:myaccount.php");
            }
        }

        public function updateUser($user, $uid){
            $sql5 = "UPDATE users SET username= '$user' WHERE user_id = '$uid'";

            $result = mysqli_query($this->connect(), $sql5);

            if($result){
                $_SESSION["response"]= "Modified successfully!";
                $_SESSION["res_type"]="success";
                header("location:myaccount.php");
            }else{
                $_SESSION["response"]= "Modification failed";
                $_SESSION["res_type"]="danger";
                header("location:myaccount.php");
            }
        }

        public function updatePassword($pass1, $password, $uid){

            if ($pass1 == $password){
                $sql6 = "UPDATE users SET passw= '$password' WHERE user_id = '$uid'";

                $result = mysqli_query($this->connect(), $sql6);

                if($result){
                    $_SESSION["response"]= "Modified successfully";
                    $_SESSION["res_type"]="success";
                    header("location:myaccount.php");
                }else{
                    $_SESSION["response"]= "Modification failed";
                    $_SESSION["res_type"]="danger";
                    header("location:myaccount.php");
                }
            }else{
                $_SESSION["response"]= "The passwords don't match.";
                $_SESSION["res_type"]="danger";
                header("location:myaccount.php");
            }

        }
        public function newPass($pass1, $password, $uid) {
            if ($pass1 == $password){
                $sql6 = "UPDATE users SET passw= '$password' WHERE user_id = '$uid'";

                $result = mysqli_query($this->connect(), $sql6);

                if($result){
                    $_SESSION["response"]= "Change successful";
                    $_SESSION["res_type"]="success";
                    header("location:login.php");
                }else{
                    $_SESSION["response"]= "Change failed";
                    $_SESSION["res_type"]="danger";
                    header("location:login.php");
                }
            }else{
                $_SESSION["response"]= "The passwords don't match.";
                $_SESSION["res_type"]="danger";
                header("location:login.php");
            }
        }

        public function user_logout() {
            $_SESSION["login"] = false;
            session_destroy();
        }
    }

?>