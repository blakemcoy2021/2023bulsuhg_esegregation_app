<?php
    include "env.php";
    $api_paths = $_SERVER['DOCUMENT_ROOT'] . "$FOLDER_NAME";


    include "$api_paths/utils.php";


    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        if (isset($_GET["auth"]) == false || $_GET["auth"] != "1") {
            cfxn_redirect('index.html');
        }
    }


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>E-segregation Dashboard</title>
</head>

<body>


    <div class="content p-3">

        <div class="container">
            <h2 class="mb-5">E-segregation Records</h2>


            <div class="table-responsive custom-table-responsive">

                <table class="table custom-table">
                    <thead>
                        <tr>

                            <th scope="col">
                                <label class="control control--checkbox">
                                    <input type="checkbox" class="js-check-all" />
                                    <div class="control__indicator"></div>
                                </label>
                            </th>

                            <th scope="col">Id</th>
                            <th scope="col">Metal Count</th>
                            <th scope="col">Paper Count</th>
                            <th scope="col">Plastic Count</th>
                            <th scope="col">Date Time</th>
                        </tr>
                    </thead>

                    <tbody id='tbl_records'>

                        <?php

                            $htm = "<tr>There are no segregation records yet.</tr>";

                            include "$api_paths/dbconfig.php";

                            $query = "select * from tbl_segregations ";
                            $query .= "order by id desc ";
                            try {
                                $conn = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME", $DBUSERNAME, $DBPASSWORD);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                                $stmt = $conn->prepare($query);
                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                $stmt->execute();

                                $records = $stmt->fetchAll();
                                if (count($records) != 0) {    // print_r($records);

                                    $htm = "";

                                    foreach ($records as $row) {
                                        $str_stream = file_get_contents("table-records.html");

                                        $arr = array(
                                            "__id" => $row["id"],
                                            "__metal" => $row["metal"],
                                            "__paper" => $row["paper"],
                                            "__plastic" => $row["plastic"],
                                            "__datetime" => $row["dtadded"]
                                        );

                                        $key_arr = array_keys($arr);
                                        for ($i = 0; $i < sizeOf($arr); $i++) {
                                            $var_name = $key_arr[$i];
                                            $str_stream = str_replace($var_name, $arr[$var_name], $str_stream);
                                        }

                                        $htm .= $str_stream;
                                    }

                                }

                            }
                            catch (PDOException $e) {
                                $htm = "<tr>There is segregation database record problem.</tr>";
                            }

                            echo $htm;
                        ?>

                        

                    </tbody>

                </table>
            </div>


        </div>

    </div>



    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dashboard/main.js"></script>

    <script>

    </script>
</body>

</html>