<?php
    include "env.php";
    $api_paths = $_SERVER['DOCUMENT_ROOT'] . "$FOLDER_NAME";


    include "$api_paths/utils.php";


    $metal = $paper = $plastic = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["metal"]))     {   $metal = $_POST["metal"];       }
        if (isset($_POST["paper"]))     {   $paper = $_POST["paper"];       }
        if (isset($_POST["plastic"]))   {   $plastic = $_POST["plastic"];   }

        $failfieldctr = 0;
        if ($metal == "") { $failfieldctr += 1; }
        if ($paper == "") { $failfieldctr += 1; }
        if ($plastic == "") { $failfieldctr += 1; }
    
        if ($failfieldctr > 0) {
            echo json_encode(cfxn_create_response(-1, "Invalid access!", "Invalid POST Attempt."));
            die();
        }

        include "$api_paths/dbconfig.php";

        $query = "insert into tbl_segregations (metal, paper, plastic)";
        $query .= "values ('$metal','$paper','$plastic'); ";

        try {
            $conn = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME", $DBUSERNAME, $DBPASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($query);
            $stmt->execute();

            $msg = "New segregation record has been succesfully added!";
            echo json_encode(cfxn_create_response(1, $msg, "API for arduino"));

        }
        catch (PDOException $e) {
            $conn = null;
            $data = "Server Error!";
            $logs = "Segregation API : db_save _ Db Exception - " . $e->getMessage();
            echo json_encode(cfxn_create_response(-1, $data, $logs));
            die();
        }

    }

?>