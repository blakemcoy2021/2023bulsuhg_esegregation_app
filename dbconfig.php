<?php

    $SERVERNAME = "localhost";
    $DBUSERNAME = "root";
    $DBPASSWORD = "toor";
    $DBNAME = "it2023_bulsuhg_esegregate";

    define('DB_CREDENTIALS', array(
        "host"=>"$SERVERNAME", "user"=>"$DBUSERNAME", 
        "pass"=>"$DBPASSWORD", "dbnm"=>"$DBNAME"));

    function cfx_get_db_credentials() {
        return DB_CREDENTIALS;
    }

    Class DB_mysqli {

        private $db; 
        public function __construct($dbargs) {

            $host = $dbargs["host"];
            $user = $dbargs["user"];
            $pass = $dbargs["pass"];
            $dbnm = $dbargs["dbnm"];

            $conn = new mysqli($host, $user, $pass, $dbnm);
            if ($conn->connect_error) {
                die("Failed to connect with MySQL - mysqli: " . $conn->connect_error);
            }
            else {
                $this->db = $conn;
            }
        }


        /* below functions are for ??? (e.g. APIs) operations */
        
    }    

?>