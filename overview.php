<?php
require './connection.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract the variables
    $overview = $data['overview'];

   

    // Prepare and execute the database query
    $sql="INSERT INTO overview (overview)
    VALUES ('$overview')";

     if($db->query($sql))
    {   $data=[
            "status" => "success",
            "message" => "data added"
        ];
        echo json_encode($data);
    }
    else
    {
       // getErrorMsg();
    }

}