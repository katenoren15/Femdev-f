<?php

session_start();
    class Dbcon{
        private $servername;
        private $username;
        private $password;
        private $dbname;

        public function connect(){

            //$config_file = "config.ini";
            //$config = parse_ini_file($config_file);

            $this->servername = "localhost";
            $this->username = "root";
            $this->password = "root";
            $this->dbname = "femdevblog";

            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

            if(mysqli_connect_errno()){
                echo "Database Connection Error " . mysqli_connect_error($conn);
            }else{
                return $conn;
            }
        }

        public function escape_string($value){
            return $this->connect()->real_escape_string($value);
        }

        public function run_query($sql){
            $stmt = $this->connect()->query($sql);

            if($stmt == false){
                return false;
            } else {
                return true;
            }
        }

        public function read($sql){
            $result = $this->connect()->query($sql);
            $numRows = $result->num_rows;
            if ($numRows > 0){
                while ($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
        }

        public function numRows($sql){
            $result = $this->connect()->query($sql);
            $numRows = $result->num_rows;
            return $numRows;
        }
        
        public function error($sql){
            $result = $this->connect()->query($sql);
            if (!$result){
                $error = $this->connect()->error;
            }
            return $error;
        }

        public function get($sql){
            $result = $this->connect()->query($sql);
            $row = $result->fetch_assoc();
            return $row;
        }

        public function run_multi_query($sql){
            $stmt = $this->connect()->multi_query($sql);

            if($stmt == false){
                return false;
            } else {
                return true;
            }
        }
    }
?>