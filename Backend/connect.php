<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    $link = mysqli_connect("localhost", "root", "","shopdock");
    if(!$link){
        echo "unable to connect to MYSQL with error: " . mysqli_connect_error() . php_EOL;
        exit;
    }
?>