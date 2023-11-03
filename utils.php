<?php
    function cfxn_redirect($page_url)
    {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("Location: http://$host$uri/$page_url");
        exit;
    }

    function cfxn_clean_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function cfxn_create_response($success, $data, $logs)
    {
        $response['success'] = $success;
        $response['data'] = $data;
        $response['logs'] = $logs . " @ " . date("Y-m-d G:i:s");
        return $response;
    }

    function cfxn_ellipses_maker($str, $limit) {
        if (strlen($str) > $limit) {
            $str = substr($str, 0, $limit) . "...";
        }
        return $str;
    }


?>